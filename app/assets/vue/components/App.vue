<template>
    <div class="container">
        <router-view />
        <notifications group="foo" />
    </div>
</template>

<script>
    export default {
        name: 'App'
    }
</script>
