<?php use App\Components\FunctionLibrary as FL; ?>
<?php $headTitle = 'Страница каталога' ?>
<?php include(ROOT . '/views/layouts/header.php') ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $category) : ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= (int)$category->id; ?>"
                                           class="app-category"
                                        >
                                            <?= htmlentities($category->name); ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    <?php foreach ($products as $product) : ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="/template<?= htmlentities($product->image); ?>" alt="image">
                                        <h2>$<?= (float)$product->price; ?></h2>
                                        <p>
                                            ID <?= (int)$product->id; ?>
                                            <a href="/product/<?= (int)$product->id; ?>"
                                               class="app-underline"
                                            >
                                                <?= htmlentities($product->name); ?>
                                            </a>
                                        </p>
                                        <a href="#"
                                           class="btn btn-default add-to-cart"
                                           data-id="<?= (int)$product->id; ?>"
                                        >
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                    </div>
                                    <?php if ($product->is_new) : ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!--features_items-->
                <div class="text-center"><?php if (isset($pagination)) { echo $pagination->get(); } ?></div>
            </div>
        </div>
    </div>
</section>

<?php include(ROOT . '/views/layouts/footer.php') ?>