<script setup>  
import { computed, ref } from 'vue'
import IconError from '../Atoms/AlertIcons/IconError.vue';
import IconInfo from '../Atoms/AlertIcons/IconInfo.vue';
import IconSuccess from '../Atoms/AlertIcons/IconSuccess.vue';
import IconWarning from '../Atoms/AlertIcons/IconWarning.vue';
import FancyButton from '../Atoms/FancyButton.vue';

    const props = defineProps({
        type: { type: String, default: 'info' }
    })

    const emit = defineEmits(['closed'])

    const alertType = computed(() => {
        return {
            info: 'alert-info',
            success: 'alert-success',
            warning: 'alert-warning',
            error: 'alert-error'
        } [props.type];
    })

    const icon = computed(() => {
        return {
            info: IconInfo,
            success: IconSuccess,
            warning: IconWarning,
            error: IconError
        } [props.type];
    })

    const closed = ref(false);
    function close(){
        closed.value = true;
        emit('closed')
    }

    /*
    // An example of how to use the AppAlerts component:
        <div class="container mx-auto">
            <AppAlerts type="info" @closed="handleClose">New software update available.</AppAlerts>
            <AppAlerts type="success" @closed="handleClose">Operation completed successfully.</AppAlerts>
            <AppAlerts type="warning" @closed="handleClose">Please check your input.</AppAlerts>
            <AppAlerts type="error" @closed="handleClose">An error occurred.</AppAlerts>
        </div>
    */
</script>

<template>
    <div role="alert" :class="`alert ${alertType}`" v-if="!closed">
        <component :is="icon"></component>
        <span><slot></slot></span>
        <FancyButton @click="close">x</FancyButton>
    </div>
</template>