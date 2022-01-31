<template>
    <li class="nav-item">
        <a class="nav-link" href="/basket">
            Корзина {{ quantity }}
        </a>
    </li>
</template>

<script>
    export default {
        computed: {
            quantity () {
                const qn = this.$store.state.basketProductsQuantity
                return qn ? `(${qn})` : ''
            }
        },
        mounted () {
            this.$store.dispatch('getBasketProductsQuantity', {})
        }
    }
</script>
