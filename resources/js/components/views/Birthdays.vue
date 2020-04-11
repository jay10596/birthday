<template>
    <ContactsList endpoint="/api/birthdays"/>
</template>

<script>
    import ContactsList from './ContactsList'

    export default {
        name: 'Birthdays',

        components: {ContactsList},
    }
</script>

<style>

</style>