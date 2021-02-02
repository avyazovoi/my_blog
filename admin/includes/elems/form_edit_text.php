<details class="edit">
    <summary class="edit__summary">Редактировать текст</summary>
    <form action="../admin/?edit=<?= $_GET['edit'] ?>" method="POST">
        <div class="form__row">
            <div class="form__item">
                <textarea class="form__textarea form__control" name="text" rows="5"
                          placeholder="Input a new text"></textarea>
            </div>
            <div class="form__button">
                <input class="button" type="submit" name="edit_text">
            </div>
        </div>
    </form>
</details>