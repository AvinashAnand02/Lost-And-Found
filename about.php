<div class="col-12">
    <div class="card">
        <div class="card-body pt-4">
            <div class="container-fluid page-content">
                <?php 
                    if(is_file(base_app.'pages/about.html'))
                    echo file_get_contents((base_app.'pages/about.html'));
                ?>
            </div>
        </div>
    </div>
</div>