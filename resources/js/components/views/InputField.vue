<template>
    <div class="relative pb-8">
        <label :for="name" class="text-blue-500 text-xs font-bold absolute p-1">{{label}}</label>
        <input :id="name" class="pt-8 pb-2 p-1 w-96 border-b focus:outline-none focus:border-blue-400 text-gray-900 text-sm" :class="changeColor()" v-model="value" :placeholder="placeholder" type="text" @input="updateField()">
    
        <p v-if='errors' v-text="errorMessage()" class=" p-1 text-xs text-red-500"></p>
    </div>
</template>

<script>
    export default {
        name: 'InputField',

        props: [
            'name', 'label', 'placeholder', 'errors', 'data'
        ],

        data() {
            return {
                value: ''
            }
        },

        methods: {
            updateField() {
                this.$emit('updatingField', this.value)
                
                this.clearError(this.name)
            },

            clearError() {
                if(this.errors) {
                    this.errors[this.name][0] = null
                }
            },

            errorMessage() {
                return this.errors[this.name][0]
            },

            changeColor() {
                return {
                    'hasError': this.errors && this.errors[this.name][0]
                }
            }
            
        },
        
        watch: {
            data(val) {
                this.value = val;
            } 
        }
    }
</script>

<style>
    .hasError {
        @apply .border-b-2 border-red-500
    }
</style>