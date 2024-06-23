<div class="card-body p-4">
    <div class="d-flex flex-start">
        <div>
            <h6 class="fw-bold mb-1"><?=$newTestimonial->name?></h6>
            <div class="d-flex align-items-center mb-3">
                <p class="mb-0 text-secondary">
                    <?=date('d.m.Y', strtotime($newTestimonial->created_at))?>
                </p>
            </div>
            <p class="mb-0">
                <?=$newTestimonial->message?>
            </p>
        </div>
    </div>
</div>
<hr class="my-0" />
