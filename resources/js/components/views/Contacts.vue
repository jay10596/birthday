<template>
    <ContactsList endpoint="/api/contacts"/>
</template>

<script>
    import ContactsList from './ContactsList'

    export default {
        name: 'Contacts',

        components: {ContactsList},
    }
</script>

<style>

</style>