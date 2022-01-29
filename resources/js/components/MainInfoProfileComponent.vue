<template>
    <div class="accordion" id="accordionMainInfo">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingMain">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMain" aria-expanded="false" aria-controls="collapseMain">
                    Общая информация
                </button>
            </h2>
            <div id="collapseMain" class="accordion-collapse collapse" aria-labelledby="headingMain" data-bs-parent="#accordionMainInfo">
                <div class="accordion-body">
                    <div>
                        <div class="mb-3">
                            <label class="form-label">Почта</label>
                            <input type="email" name="email" class="form-control" :value="user.email">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Имя</label>
                            <input class="form-control" :value="user.name">
                        </div>
                        <div class="mb-3">
                            <img style="height:100px;margin-bottom: 10px;border-radius: 100px;border: 2px solid grey;"
                                 :src="'/storage/img/users/' + user.picture">
                            <input class="form-control" name="picture" type="file">
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
    name: "MainInfoProfileComponent",
    props: ['user']
}
</script>

<style scoped>

</style>
