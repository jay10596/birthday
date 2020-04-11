<template>
  
</template>

<script>
    export default {
        name: 'Logout',

        created() {
            axios.post('/logout', {})
                .finally(res => {
                    window.location = '/login'
                })
        }
    }
</script>

<style>

</style>