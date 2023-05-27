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
                <div class="ms-3 my-3 align-self-start"><?=$product->description?> Lorem ipsum dolor sit amet, consectetur adipisicing elit. A blanditiis culpa dolore esse illum laborum minima non nulla, perferendis porro tempora voluptates. Accusantium commodi ea eaque ex, necessitatibus ut voluptate.    </div>
            </div>
            <div class="card-footer py-3 d-flex align-items-center justify-content-between flex-wrap">
                <button class="btn btn-dark">Оставить отзыв</button>
                <h4 class="my-0 fw-normal text-end"><?=$product->price?> <span class="fw-bold text-secondary">&#8381;</span></h4>
            </div>
        </div>
    </div>

    <!--Форма для добавления отзыва-->
    <form class="col">
        <div class="card mb-4 rounded-1 shadow-sm">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal text-start">Добавление отзыва</h4>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-around testimonial-user-data">
                    <div class="flex-fill pe-3 mb-3">
                        <label for="name" class="form-label">Введите ваше имя:</label>
                        <input type="text" class="form-control" id="name" aria-describedby="textHelp" required>
                    </div>
                    <div class="flex-fill ps-3 mb-3">
                        <label for="email" class="form-label">Введите адрес email:</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div>
                    <label for="message" class="form-label">Введите сообщение:</label>
                    <textarea class="form-control" id="message" rows="3" aria-describedby="textHelp" required></textarea>
                </div>
            </div>
            <div class="card-footer py-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Отправить отзыв</button>
            </div>
        </div>
    </form>

    <!--Отзывы о товаре-->
    <div class="col">
        <div class="card text-dark">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal text-start">Отзывы о товаре</h4>
            </div>


            <div class="card-body p-4">
                <div class="d-flex flex-start">
                    <div>
                        <h6 class="fw-bold mb-1">Алексей Иванов</h6>
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 text-secondary">
                                20 мая 2023
                            </p>
                        </div>
                        <p class="mb-0">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias, dignissimos distinctio est fuga non officiis omnis praesentium repellat saepe! Dignissimos dolorum eum in ipsa labore libero necessitatibus nobis, voluptatibus.
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-0" />


            <div class="card-body p-4">
                <div class="d-flex flex-start">
                    <div>
                        <h6 class="fw-bold mb-1">Сергей Петров</h6>
                        <div class="d-flex align-items-center mb-3">
                            <p class="mb-0 text-secondary">
                                1 мая 2023
                            </p>
                        </div>
                        <p class="mb-0">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias, dignissimos distinctio est fuga non officiis omnis praesentium repellat saepe! Dignissimos dolorum eum in ipsa labore libero necessitatibus nobis, voluptatibus.
                        </p>
                    </div>
                </div>
            </div>



        </div>
    </div>


</div>