<template>
    <div class="tags">
        <template v-if="type === 'textarea'">
            <textarea v-model="textInput" :class="['form-control', valid]" :name="`${name}-text`" cols="30" rows="10"></textarea>
        </template>
        <template v-else>
            <input type="text" v-model="textInput" :class="['form-control', valid]" :name="`${name}-text`">
        </template>

        <div class="tag-group">
            <template v-for="(tag, i) in tags">
                <input type="hidden" :value="tag" :name="`${name}[${i}]${object ? `[${object}]` : ``}`">
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
            type: String,
            object: String
        },
        data() {
            return {
                textInput: this.value
            }
        },
        computed: {
            tags(){
                return this.textInput.split(",")
            }
        },

    }
</script>
