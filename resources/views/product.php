<?php layout('header', $_VARS); ?>
<div class="row row-cols-1 mb-3">

    <!--Карточка товара-->
    <div class="col">
        <div class="card mb-4 rounded-1 shadow-sm">
            <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
                <h4 class="my-0 fw-normal text-start"><?=$product->name?></h4>
                <button class="btn btn-primary">В корзину</button>
            </div>
            <div class="card-body d-flex align-items-center product-info">
                <img src="<?=$product->image?>" alt="<?=$product->name?>" class="card-img card-img-fixed">
                <div class="ms-3 my-3 align-self-start"><?=$product->description?></div>
            </div>
            <div class="card-footer py-3 d-flex align-items-center justify-content-between flex-wrap">
                <button class="btn btn-dark" id="testimonial-open">Оставить отзыв</button>
                <h4 class="my-0 fw-normal text-end"><?=$product->price?> <span class="fw-bold text-secondary">&#8381;</span></h4>
            </div>
        </div>
    </div>

    <!--Форма для добавления отзыва-->
    <form action="/testimonial/add" method="post" class="col" style="display:none" id="testimonial-form">
        <input type="hidden" name="product_id" value="<?=$product->id?>">
        <div class="card mb-4 rounded-1 shadow-sm">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal text-start">Добавление отзыва</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-around testimonial-user-data">
                    <div class="flex-fill pe-3 mb-3">
                        <label for="name" class="form-label">Введите ваше имя:</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="textHelp" required>
                    </div>
                    <div class="flex-fill ps-3 mb-3">
                        <label for="email" class="form-label">Введите адрес email:</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div>
                    <label for="message" class="form-label">Введите сообщение:</label>
                    <textarea class="form-control" id="message" name="message" rows="3" aria-describedby="textHelp" required></textarea>
                </div>
            </div>
            <div class="card-footer py-3 d-flex justify-content-between align-items-start">
                <div>
                    <ul class="text-danger" id="testimonial-errors">
                    </ul>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Отправить отзыв</button>
            </div>
        </div>
    </form>

    <!--Отзывы о товаре-->
    <div class="col testimonials">
        <div class="card text-dark">
            <div class="card-header py-3" id="testimonials-header">
                <h4 class="my-0 fw-normal text-start">Отзывы о товаре</h4>
            </div>

            <?php if (!$testimonials): ?>
                <div class="card-body p-4" id="testimonial-empty">
                    Отзывов пока нет.
                </div>
            <?php else:
                foreach ($testimonials as $testimonial): ?>
                <div class="card-body p-4">
                    <div class="d-flex flex-start">
                        <div>
                            <h6 class="fw-bold mb-1"><?=$testimonial['name']?></h6>
                            <div class="d-flex align-items-center mb-3">
                                <p class="mb-0 text-secondary">
                                    <?=date('d.m.Y', strtotime($testimonial['created_at']))?>
                                </p>
                            </div>
                            <p class="mb-0">
                                <?=$testimonial['message']?>
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <?php endforeach;
            endif; ?>
        </div>
    </div>


</div>
<?php layout('footer', $_VARS); ?>
