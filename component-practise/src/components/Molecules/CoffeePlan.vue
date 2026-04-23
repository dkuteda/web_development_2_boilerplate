<script setup>
    import { ref } from 'vue';

    const props = defineProps({
        name: {type: String, default: 'Default Plan', validator(value) {
            return value.startsWith('The');
        }},
        price: {type: Number, default: 0},
        selected: {type: Boolean, default: false}
    })

    const emit = defineEmits({
        selected(payload) {
            return typeof payload.name === 'string' && typeof payload.price === 'number'
        }
    })

    function selecetPlan() {
        emit ('selected', props.name, props.price)
    }
</script>

<template>
    <div @click="selecetPlan" class="plan" :class="{ 'active-plan': selected }">
        <div class="description">
          <span class="title"> {{ name }} </span>
          <span class="price">${{ price }}</span>
        </div>
    </div>
</template>