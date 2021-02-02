<details class="edit">
    <summary class="edit__summary">Редактировать заголовок</summary>
    <form action="../admin/?edit=<?= $_GET['edit'] ?>" method="POST">
        <div class="form__row">
            <div class="form__item">
                <input class="form__control" type="text" name="title" placeholder="Input a new title">
            </div>
            <div class="form__button">
                <input class="button" type="submit" name="edit_title">
            </div>
        </div>
    </form>
</details>