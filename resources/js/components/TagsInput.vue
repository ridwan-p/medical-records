<template>
    <div class="tags">
        <input type="text" v-model="textInput" :class="['form-control', valid]" :name="`${name}-text`">
        <div class="tag-group">
            <template v-for="(tag, i) in tags">
                <input type="hidden" :value="tag" :name="`${name}[${i}]`">
                <span class="badge badge-pill badge-info mr-1">{{tag}}</span>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            value: String,
            valid: String,
            name: String,
        },
        data() {
            return {
                textInput: this.value
            }
        },
        computed: {
            tags(){
                return this.textInput.split(',')
            }
        },

    }
</script>
