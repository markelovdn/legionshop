<template>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Изменить пароль
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div>
                        <div class="mb-3">
                            <label class="form-label">Текущий пароль</label>
                            <input autocomplete="new-password" class="form-control"
                                   name="current_password" type="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Новый пароль</label>
                            <input class="form-control" name="password" type="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Повторите пароль</label>
                            <input class="form-control" name="password_confirmation" type="password">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PasswordComponent"
}
</script>

<style scoped>

</style>
