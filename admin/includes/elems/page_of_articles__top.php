<div class="articles__top">
    <div class="articles__title">
        <?php
        if (isset($_POST['select'])) {
            if ($_POST['categorie'] == 'all_categories') {
                $categorie_id = '';
                echo 'Все Ваши статьи';
            } else {
                $categorie_id = $_POST['categorie'];
                foreach ($categories as $cat) {
                    if ($categorie_id == $cat['id']) {
                        echo 'Все статьи категории: ' . $cat['title'];
                    }
                }
            }
        } else {
            echo 'Все Ваши статьи';
        }
        ?>
    </div>
    <div class="articles__all">
        <form class="form-select" method="POST">
            <select name="categorie" required>
                <div class="form-select__top">
                    <option value="all_categories">Все категории</option>
                    <?php
                    foreach ($categories as $cat) {
                        ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                        <?php
                    }
                    ?>
                </div>
                <div class="form-select__button">
                    <input type="submit" name="select" class="button" value="Выбрать категорию">
                </div>
            </select>
        </form>
    </div>
    <a href="/admin/?add_article">Добавить новую статью</a>