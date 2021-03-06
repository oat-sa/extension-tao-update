

function updateProgessClass(successMsg,successUrl){
	this.$updateGrid = $('#update-grid');
	this.$stepGrid = $('#update-step-grid');
	this.moduleUrl = root_url + 'taoUpdate/Update/'
	this.availableUpdatesUrl = this.moduleUrl + 'availableUpdates';
	this.availableStepsUrl = this.moduleUrl + 'getUpdateSteps'
	this.successMsg = successMsg;
	this.successUrl = successUrl;
	this.img_root = root_url + "/taoUpdate/views/img/";
	this.availableSteps = [];
	this.stepIndex = 0;
	
}


updateProgessClass.prototype.init = function(availlableUpdates){
	var self = this;

	require(['require', 'jquery', 'grid/tao.grid'], function(req, $) {
		self.$updateGrid.jqGrid({

			datatype: "local", 
			hidegrid : false,
			colNames: [ __('Version'), __('File'),__('Informations'),''], 
			colModel: [ 
			           {name: 'version', index: 'version',align: 'center', sortable: false},
			           {name: 'file', index: 'file', align: 'center', sortable: false},
			           {name: 'messages', index : 'messages', align: 'center', width: 700, resizable: true, sortable: false},
			           {name:'actions',index:'actions', align:"center", width: 30, sortable: false}

			           ], 

			           rowNum:10,
			           height: 'auto', 
			           width:'auto', 

			           caption: __("Available Update"),

		});

		var i = 0;

		for (var update in availlableUpdates){
			var row = availlableUpdates[update];

			row.actions = '<input type="radio" name="update-to-version" value="' + update + '" />'
			self.addRow(self.$updateGrid, i, row);
			i++;
		}

	});	

	

}

updateProgessClass.prototype.activeSteps = function(){
	this.$stepGrid.empty();
	$('#update-table-container').hide();


	var self = this;
	
	$.getJSON(self.availableStepsUrl, function(data) {
		
		require(['require', 'jquery', 'grid/tao.grid'], function(req, $) {
			self.$stepGrid.jqGrid({
				datatype: "local", 
				hidegrid : false,
				colNames: [ __('Step'), __('Name'),__('Status'),], 
				colModel: [ 
							{name: 'step', index: 'step', sortable: false ,align: 'center'},
							{name: 'name', index: 'name', width: 250, sortable: false},
							{name: 'status' , index:'status', sortable: false, align: 'center'},
						], 
		
				rowNum:10,
				height: 'auto', 
				width:'auto', 
		
				caption: __("Update in progress"),
							         
			});
			var i = 0;

				$.each(data, function(key, val) {
					var divStatus = '<div id="update-step-action-' + val.action + '">' 
					var row = {'step':i+1,'name':val.name,'status': divStatus + val.status + '</div>'};
					self.addRow(self.$stepGrid, i, row);
					self.availableSteps.push(val);
					i++;
					
				});
			
			
			});
		self.updateProgress();
		
	});

	return true;
}


updateProgessClass.prototype.updateProgress = function() {

	//update progress bar
	
	if(this.stepIndex<this.availableSteps.length){

		this.run(this.availableSteps[this.stepIndex]);
	
		this.stepIndex++;
	}else{
		$("#init-update").show();
		this.$stepGrid.show();
		$("#update-table-container").hide();

		$('#update-button-container').hide();
		var info = $('#update-info').removeClass('ui-state-error').addClass('ui-state-highlight');
		info.html('<img src="'+this.img_root+'tick.png"/>' + this.successMsg + '<a href="' + this.successUrl + '">Click here to proceed.</a>');	

	}
}

updateProgessClass.prototype.setParams = function(data){
	this.params = data;
}
updateProgessClass.prototype.addParams = function(action){
	
	if(this.params != null && action !=null){
		var truc = {'action':action,'versionName':this.params.versionName};
		var encoded = jQuery.param(truc);
		return '?'  + encoded;
	}
	return;
}

updateProgessClass.prototype.run = function(step){
	var self = this;

	var actionStatusTag = $('#update-step-action-' + step.action);
	var url = self.moduleUrl + 'run'  + this.addParams(step.action) ;

	
	
	actionStatusTag.html( __('In progress...'));
	$('<img src="'+ self.img_root + 'ajax-loader-small.gif' +'" title="'+ __('In progress...') +'"/>').css('top', 2).appendTo(actionStatusTag);

	$.getJSON(url, function(data) {

		if(data.success == 1){
			actionStatusTag.html( __('Complete') + ' <img src="'+self.img_root+'tick.png"/>');	
			self.updateProgress();
		}
		else {

			$("#init-update").show();

			
			actionStatusTag.html( __('Fail') + ' <img src="'+self.img_root+'failed.png"/>');
			var error = $('#update-info').removeClass('ui-state-highlight').addClass('ui-state-error');
			error.empty();
			$.each(data.failed, function(key, val) {
				$('<p>' + val +'<p>').appendTo(error);
				
				
			});

		}

	});
		
}

updateProgessClass.prototype.formatMessage = function(data){
	var message = '<div id="update-version-info">';
	var noInfo =  '<div id="update-version-noinfo">' + __('No Informations Available') ;
	for (var msg in data.messages){
		message += '<ul class="' + msg  + '"><li>' + data.messages[msg].join('</li><li>') + '</li></ul>';
	}
	if(typeof data.messages != "undefined" && data.messages != null && data.messages.length == 0){
		message = noInfo;
	}
	return message + '</div>';

}


updateProgessClass.prototype.addRow = function(grid, rowId, data) {
	data.messages = this.formatMessage(data);
	grid.jqGrid('addRowData', rowId, data);
}

