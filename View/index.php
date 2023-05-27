<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <?php
    foreach ($products as $product) {
        ?>
        <a href="/products/<?=$product['id']?>" class="text-decoration-none">
        <div class="col">
            <div class="card mb-4 rounded-1 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal"><?=$product['name']?></h4>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center card-body-fixed">
                    <img src="<?=$product['image']?>" alt="<?=$product['name']?>" class="card-img">
                </div>
                <div class="card-footer py-3">
                    <h4 class="my-0 fw-normal text-end"><?=$product['price']?> <span class="fw-bold text-secondary">&#8381;</span></h4>
                </div>
            </div>
        </div>
        </a>
        <?php
    }
    ?>
</div>
