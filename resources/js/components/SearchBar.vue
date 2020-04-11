<template>
    <div class="h-16 px-3 border-b-2 border-gray-400 flex items-center justify-between">
        <div class="">
            {{title}}
        </div>

        <div class="flex">
            <SearchTab/>
            <UserCircle :name="name"/>
        </div>
    </div>
</template>

<script>
    import UserCircle from './views/UserCircle'
    import SearchTab from './views/SearchTab'

    export default {
        name: "SearchBar",

        components: {UserCircle, SearchTab},

        props: [
            'name', 'title'
        ],
    }
</script>

<style>

</style>