<?php 
if(isset($_GET['cid'])){
    $category_qry = $conn->query("SELECT * FROM `category_list` where `id` = '{$_GET['cid']}'");
    if($category_qry->num_rows > 0){
        foreach($category_qry->fetch_assoc() as $k => $v){
            $cat[$k] = $v; 
        }
    }
}
?>
<h1 class="pageTitle text-center titleTxt">Lost and Found Items</h1>
<hr class="mx-auto bg-primary border-primary opacity-100" style="width:50px">

<div class="container-sm">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="list-group">
                <?php 
                $qry = $conn->query("SELECT * FROM `category_list` where `status` = 1 ");
                while($row = $qry->fetch_assoc()):
                ?>
                <a href="<?= base_url.'?page=items&cid='.$row['id'] ?>" class="list-group-item list-group-item-action<?= (isset($_GET['cid']) && $_GET['cid'] == $row['id']) ? ' active': '' ?>"><?= $row['name'] ?></a>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12">
        <?php if(isset($cat['name'])): ?>
            <h3 class="titleTxt"><?= $cat['name'] ?></h3>
        <?php endif; ?>
        <?php if(isset($cat['description'])): ?>
            <div ><?= str_replace("\n", "<br>", htmlspecialchars_decode($cat['description'])) ?></div>
        <?php endif; ?>
            <?php 
            $where = "";
            if(isset($cat['id'])){
                $where = " and `category_id` = '{$cat['id']}'";
            }
            $items = $conn->query("SELECT * FROM `item_list` where `status` = 1 {$where} order by `title` asc")->fetch_all(MYSQLI_ASSOC);
            ?>
            <div id="item-list">
                <?php if(count($items) > 0): ?>
                <?php foreach($items as $row): ?>
                <a href="<?= base_url.'?page=items/view&id='.$row['id'] ?>" class="item-item text-decoration-none text-reset">
                    <div class="card">
                        <div class="item-card-img">
                            <img src="<?= validate_image($row['image_path']) ?>" alt="">
                        </div>
                        <div class="card-body pt-3">
                            <h4 class="card-title"><?= $row['title'] ?></h4>
                            <p class="truncate-3"><?= strip_tags(htmlspecialchars_decode($row['description'])) ?></p>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php if(count($items) <= 0): ?>
                <div class="text-muted text-center">No item Listed Yet</div>
            <?php endif; ?>
        </div>
    </div>
</div>