<form class="form-horizontal" role="form" action="{{ '/vehicles/get_vehicle_maintenance_docs/' . $vehicleMaintenancehistory->id }}" id="editMaintenanceHistory" data-upload-template-id="template-upload-1" data-download-template-id="template-download-1">
    <div class="modal-header bg-red-rubine d-flex align-items-center justify-content-between">
        <h4 class="modal-title">Edit Maintenance Event</h4>
        <a class="font-red-rubine" data-dismiss="modal" aria-label="Close" id="editMaintenanceHistoryClose">
            <i class="jv-icon jv-close"></i>
        </a>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row gutters-tiny">
                    <label class="col-md-3 control-label">Event*:</label>
                    <div class="col-md-9 error-class">
                        <input type="hidden" name="is_update_pmi_schedule_edit" id="is_update_pmi_schedule_edit" value="{{ ($vehicleMaintenancehistory->eventType->slug == 'preventative_maintenance_inspection' && ($vehicleMaintenancehistory->event_date != null || $vehicleMaintenancehistory->event_date != '')) ? 0 : 'N/A' }}">
                        <input type="hidden" name="plan_date_hidden" id="plan_date_hidden" value="{{ ($vehicleMaintenancehistory->event_plan_date != null && $vehicleMaintenancehistory->event_plan_date != '') ? $vehicleMaintenancehistory->event_plan_date : '' }}">
                        <input type="hidden" name="dt_mot_expiry" id="dt_mot_expiry" value="{{ ($vehicleMaintenancehistory->vehicle->dt_mot_expiry != null && $vehicleMaintenancehistory->vehicle->dt_mot_expiry != '') ? $vehicleMaintenancehistory->vehicle->dt_mot_expiry : '' }}">
                        <select class="form-control select2me select2-edit-maintenance-event-type" id="edit_maintenance_event_type" name="edit_maintenance_event_type" placeholder="Select" {{ $vehicleMaintenancehistory->created_by == 1 ? 'disabled' : '' }}>
                            @foreach($maintenanceEventTypes as $key => $event)
                                <option value="{{ $event->id }}" data-slug="{{ $event->slug }}" {{ $event->id == $vehicleMaintenancehistory->event_type_id ? 'selected' : '' }}>{{ $event->name }}</option>
                            @endforeach
                      </select>
                    </div>
                </div>

                @if($vehicleMaintenancehistory->created_by == 1)
                <div class="form-group row gutters-tiny js-maintenance-planned-distance {{ ($vehicleMaintenancehistory->eventType->slug == 'next_service_inspection_distance' && $vehicleMaintenancehistory->vehicle->type->service_interval_type == 'Distance') ? '' : 'hide' }}">
                    <label class="col-md-3 control-label">Planned distance:</label>
                    <div class="col-md-9 error-class">
                        <input type="text" size="16" disabled="disabled" class="form-control" name="edit_maintenance_planned_distance" id="edit_maintenance_planned_distance" value="{{ number_format($vehicleMaintenancehistory->event_planned_distance,0) }}">
                    </div>
                </div>
                @endif
                
                @if($vehicleMaintenancehistory->created_by == 1 || $vehicleMaintenancehistory->eventType->slug == 'preventative_maintenance_inspection')
                <div class="form-group row gutters-tiny">
                    <label class="col-md-3 control-label">Planned date<span class="js-planned-date">*</span>:</label>
                    <div class="col-md-9 error-class">
                        <div class="input-group date maintenance_history_form_date">
                            <input type="text" size="16" {{ $vehicleMaintenancehistory->eventType->slug != 'next_service_inspection_distance' ? 'readonly' : '' }} {{ $vehicleMaintenancehistory->eventType->slug != 'next_service_inspection_distance' ? 'disabled="disabled"' : '' }} class="form-control" name="edit_maintenance_planned_date" id="edit_maintenance_planned_date" value="{{isset($vehicleMaintenancehistory->event_plan_date) ? $vehicleMaintenancehistory->event_plan_date : ''}}" placeholder="Select">
                            <span class="input-group-btn">
                            <button class="btn default date-set grey-gallery btn-h-45" {{ $vehicleMaintenancehistory->eventType->slug != 'next_service_inspection_distance' ? 'disabled="disabled"' : '' }} type="button"><i class="jv-icon jv-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-group row gutters-tiny">
                    <label class="col-md-3 control-label">Event date<span class="js-required">*</span>:</label>
                    <div class="col-md-9 error-class">
                        <div class="input-group date form_date maintenance_history_form_date">
                            <input type="text" size="16" class="form-control bg-white cursor-pointer" name="edit_maintenance_event_date" id="edit_maintenance_event_date" value="{{isset($vehicleMaintenancehistory->event_date) ? $vehicleMaintenancehistory->event_date : ''}}" @if(($vehicleMaintenancehistory->eventType->slug == 'preventative_maintenance_inspection' || $vehicleMaintenancehistory->eventType->slug == 'mot') && $vehicleMaintenancehistory->event_date != null) disabled style="background: #f4f4f4 !important;cursor: not-allowed !important;" @else readonly @endif placeholder="Select">
                            <span class="input-group-btn">
                            <button class="btn default date-set grey-gallery btn-h-45" @if(($vehicleMaintenancehistory->eventType->slug == 'preventative_maintenance_inspection' || $vehicleMaintenancehistory->eventType->slug == 'mot') && $vehicleMaintenancehistory->event_date != null) disabled="disabled" @endif type="button"><i class="jv-icon jv-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group row gutters-tiny js-maintenance-odometer-reading">
                    <label class="col-md-3 control-label">Odometer reading:</label>
                    <div class="col-md-9 error-class">
                        <div class="input-group">
                            <input type="text" size="16" class="form-control bg-white cursor-pointer" name="edit_maintenance_odometer_reading" id="edit_maintenance_odometer_reading" value="{{isset($vehicleMaintenancehistory->odomerter_reading) ? $vehicleMaintenancehistory->odomerter_reading : ''}}">
                        <span class="input-group-addon" id="odometer_reading_unit_display">{{ $vehicleMaintenancehistory->vehicle->type->odometer_setting == 'km' ? 'KM' : 'Miles' }}</span>
                        </div>
                    </div>
                </div>

                <div class="edit_mot_show_hide" @if($vehicleMaintenancehistory->eventType->slug!='mot') style="display:none" @endif>
                    <div class="form-group row gutters-tiny">
                        <label class="col-md-3 control-label">Type<span class="js-required">*</span>:</label>

                        <div class="col-md-9 error-class">
                            <select class="form-control select2me select2-edit-maintenance-mot-type" id="edit_maintenance_mot_type" name="edit_maintenance_mot_type" placeholder="Select">
                                <option></option>
                                <option value="Initial" {{$vehicleMaintenancehistory->mot_type == 'Initial' ? 'selected' : ''}}>Initial</option>
                                <option value="Re-test" {{$vehicleMaintenancehistory->mot_type == 'Re-test' ? 'selected' : ''}}>Re-test</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row gutters-tiny">
                        <label class="col-md-3 control-label">Outcome<span class="js-required">*</span>:</label>

                        <div class="col-md-9 error-class">
                            <select class="form-control select2me select2-edit-maintenance-mot-outcome" id="edit_maintenance_mot_outcome" name="edit_maintenance_mot_outcome" placeholder="Select">
                                <option></option>
                                <option value="Fail" {{$vehicleMaintenancehistory->mot_outcome == 'Fail' ? 'selected' : ''}}>Fail</option>
                                <option value="Pass" {{$vehicleMaintenancehistory->mot_outcome == 'Pass' ? 'selected' : ''}}>Pass</option>
                                <option value="PRS" {{$vehicleMaintenancehistory->mot_outcome == 'PRS' ? 'selected' : ''}}>PRS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row gutters-tiny">
                    <label class="col-md-3 control-label">Status*:</label>
                    <div class="col-md-9 error-class">
                        <select class="form-control select2me select2-edit-maintenance-status" placeholder="Select" id="edit_maintenance_status" name="edit_maintenance_status" {{ $vehicleMaintenancehistory->eventType->slug == 'preventative_maintenance_inspection' && $vehicleMaintenancehistory->event_status == 'Complete' ? 'disabled' : '' }}>
                            @foreach ($maintenanceHistoryStatus as $key => $status)
                                <option value="{{ $key }}" {{ $key == $vehicleMaintenancehistory->event_status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                      </select>
                    </div>
                </div>

                <div class="form-group row gutters-tiny">
                    <label class="col-md-3 control-label">Comments<span class="js-required">*</span>:</label>
                    <div class="col-md-9 error-class">
                        <textarea rows="4" class="form-control maintenance-history-comments-textarea" id="edit_maintenance_comments" name="edit_maintenance_comments" value="" placeholder="Enter details">{{isset($vehicleMaintenancehistory->comment) ? $vehicleMaintenancehistory->comment : ''}}</textarea>
                    </div>
                </div>

                @if($isDVSAConfigurationTabEnabled)
                <div class="form-group row gutters-tiny js-maintenance-acknowledgment {{ $vehicleMaintenancehistory->eventType->slug == 'preventative_maintenance_inspection' ? '' : 'hide'}}">
                    <label class="col-md-3 control-label">Acknowledgment<span class="js-acknowledgment-required">*</span>:</label>
                    <div class="col-md-9 error-class">
                        <p>Has the safety inspection sheet been completed in line with DVSA requirements and where appropriate the vehicle/asset been signed off as roadworthy or the relevant procedures taken where remedial actions are required?</p>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="radio-default-overright">
                                    <input type="radio" name="edit_acknowledgment" class="js-acknowledgment-radio" value="yes" {{ $vehicleMaintenancehistory->is_safety_inspection_in_accordance_with_dvsa == "1" ? 'checked=checked' : '' }}> Yes
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label class="radio-default-overright">
                                    <input type="radio" name="edit_acknowledgment" class="js-acknowledgment-radio" value="no" {{ $vehicleMaintenancehistory->is_safety_inspection_in_accordance_with_dvsa == "0" ? 'checked=checked' : '' }}> No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="hidden" name="vehicle_maintenance_docs_url" id="vehicle_maintenance_docs_url" value="{{ '/vehicles/get_vehicle_maintenance_docs/' . $vehicleMaintenancehistory->id }}">
                        <div class="fileupload-buttonbar">
                            <div class="dropZoneElement">
                                <div class="fileinput-button">
                                    <div>
                                        <p class="fileinput-button-title"><span>+</span>Add file</p>
                                        <p class="dropImageHereText">Click or drop your file here to upload</p>
                                        <input type="file" name="files-1[]" multiple="" accept=".gif, .jpg, .jpeg, .png, .doc, .docx, .xls, .xlsx, .csv, .pdf">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="help-block text-center">(*.gif, *.jpg, *.jpeg, *.png, *.doc, *.docx, *.xls, *.xlsx, *.csv, *.pdf)</div>

                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped table-hover custom-table-striped maintenanceEventDetail clearfix" id="upload-media-table-1">
                            <thead>
                                <th>Preview</th>
                                <th>Document Name</th>
                                <th style="text-align: right; white-space: nowrap;">Actions</th>
                            </thead>
                            <tbody class="files">
                            </tbody>
                        </table>
                        <script id="template-upload-1" type="text/x-tmpl">
                            {% for (var i=0, file; file=o.files[i]; i++) { %}
                                <tr class="template-upload fade">
                                    <td>
                                        <span class="preview">
                                        </span>
                                    </td>
                                    <td class="js-file-name-td">
                                        <input type="text" placeholder="Enter document name" id="caption" name="name" class="form-control"/>
                                        <span class="help-block help-block-error" style="display: none;">This field is required</span>
                                        <!-- <div class="progress progress-striped progress-bar-red-rubine active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-red-rubine" style="width:0%;">
                                            </div>
                                        </div> -->
                                        <div class="progress mb-0 bg-grey">
                                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: right; white-space: nowrap;">

                                        {% if (!i) { %}
                                            <button class="btn grey-gallery cancel">
                                                <span>Cancel</span>
                                            </button>
                                        {% } %}
                                        {% if (!i && !o.options.autoUpload) { %}
                                            <button class="btn red-rubine start" disabled>
                                                <span>Upload</span>
                                            </button>
                                        {% } %}
                                    </td>
                                </tr>
                            {% } %}
                        </script>

                        <script id="template-download-1" type="text/x-tmpl">
                            {% for (var i=0, file; file=o.files[i]; i++) { %}
                                <tr class="template-download fade">
                                    <td>
                                        {% if (file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/jpeg') { %}
                                            <span class="jv-icon jv-file-image table-docpreview-icon"></span>
                                        {% } else if (file.type === 'image/gif') { %}
                                            <span class="jv-icon jv-file-gif table-docpreview-icon"></span>
                                        {% } else if (file.type === 'application/pdf') { %}
                                            <span class="jv-icon jv-file-pdf table-docpreview-icon"></span>
                                        {% } else if (file.type === 'application/msword' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') { %}
                                            <span class="jv-icon jv-file-word table-docpreview-icon"></span>
                                        {% } else if (file.type === 'application/mspowerpoint' || file.type === 'application/powerpoint' || file.type === 'application/vnd.ms-powerpoint' || file.type === 'application/x-mspowerpoint' || file.type === 'application/vnd.openxmlformats-officedocument.presentationml.presentation') { %}
                                            <img src="/img/document_icons/ppt.png" style="height: 45px;">
                                        {% } else if (file.type === 'application/vnd.ms-excel' || file.type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') { %}
                                            <span class="jv-icon jv-file-excel table-docpreview-icon"></span>
                                        {% } else if (file.extension === 'csv') { %}
                                            <span class="jv-icon jv-file-csv table-docpreview-icon"></span>
                                        {% } else { %}
                                            <span class="jv-icon jv-doc table-docpreview-icon"></span>
                                        {% } %}
                                    </td>
                                    <td>
                                        <p class="name">
                                            {% if (file.url) { %}
                                                <a rel="noopener" target="_blank" href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                            {% } else { %}
                                                <span>{%=file.name%}</span>
                                            {% } %}
                                        </p>
                                        {% if (file.error) { %}
                                            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                                        {% } %}
                                    </td>
                                    <td style="text-align: right">
                                        {% if (file.deleteUrl) { %}

                                            <div class="delete-wrapper">
                                                <button class="delete" style="display:none;" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                                    <i class="jv-icon jv-dustbin normal-font"></i>
                                                </button>
                                                <button class="btn btn-xs doc-delete-btn1 date-set grey-gallery tras_btn maintenance-doc-delete-btn" type="button">
                                                    <i class="jv-icon jv-dustbin normal-font"></i>
                                                </button>
                                            </div>
                                        {% } else { %}
                                            <button class="btn btn-warning cancel">
                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                <span>Cancel</span>
                                            </button>
                                        {% } %}
                                    </td>
                                </tr>
                            {% } %}
                        </script>
                        {{-- {!! BootForm::close() !!} --}}
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="maintenance_history_edit_id" id="maintenance_history_edit_id" value="{{@$vehicleMaintenancehistory->id}}">
        <input type="hidden" name="edit_vehicle_id" id="edit_vehicle_id" value="{{$vehicle->id}}">
    </div>
    <div class="modal-footer">
        <div class="col-md-offset-2 col-md-8 ">
            <div class="btn-group pull-left width100">
                <button type="button" class="btn white-btn btn-padding col-md-6" id="editMaintenanceHistoryCancle" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn red-rubine btn-padding submit-button col-md-6" id="editMaintenanceHistorySave">Save</button>
            </div>
        </div>
    </div>
</form>