<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Search Clinics</h3>
            </div>
            <div class="panel-body">
                <?php echo form_open("",array("class"=>"form-inline ls_form validate_form","role"=>"form","id"=>"filter_form","method"=>"get")); ?>
                    <div class="form-group">
                        <label class="sr-only" for="s">Clinic title</label>
                        <?php echo form_input('s', ci_get_str_parameter('s'),'class="form-control validate[minSize[3]]" id="s" placeholder="Clinic title"'); ?>
                        <input type="hidden" name="real_filter" value="true" /> 
                    </div>                                        
                    <?php echo form_submit('submit', _lang('Search'), 'class="btn btn-default"'); ?>
                    <a class="btn ls-brown-btn" href="<?php echo ci_site_url($_backstage_dir."/".$_controller);?>"><?php _elang("Show all");?></a>
                </form>
            </div>
        </div>
    </div>
</div>