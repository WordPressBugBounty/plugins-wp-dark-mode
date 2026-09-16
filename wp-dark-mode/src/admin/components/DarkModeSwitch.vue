<script setup>
import { ref, computed, defineProps, onMounted } from 'vue';
const props = defineProps({
    id: {
        type: [String, Number],
        default: 1
    },
    config: {
        type: Object,
        default: {
        }
    },
    active: {
        type: Boolean,
        default: false
    },
    activeLargeFont: {
        type: Boolean,
        default: false
    },
    dummy: {
        type: Boolean,
        default: false
    },
    size: {
        type: Number,
        default: 1
    }
});

import * as switches from './../../switches';

const id = computed(() => {
    const mod = "Switch_" + props.id;
    if (typeof switches[mod] === 'function') {
        return props.id;
    }

    return 1;
})
const config = computed(() => props.config || {});
const isActive = computed(() => props.active || false);
const isActiveLargeFont = computed(() => props.activeLargeFont || false);

const html = computed(() => {
    const mod = "Switch_" + id.value;

    // iconLight and iconDark should be wrapped in img tag if not empty 
    if (config.value.iconLight) {
        config.value.iconLight = config.value.iconLight.startsWith('http') ? `<img src="${config.value.iconLight}" />` : config.value.iconLight;
    }

    if (config.value.iconDark) {
        config.value.iconDark = config.value.iconDark.startsWith('http') ? `<img src="${config.value.iconDark}" />` : config.value.iconDark;
    }


    return switches[mod](config.value);
});

const switchEl = ref(null)

</script>
<template>
    <div ref="switchEl" class="wp-dark-mode-ignore wp-dark-mode-switch ignore dummy" :class="`${props.dummy && id == 24 ? 'scale-75' : ''} wp-dark-mode-switch-${id} ${isActive ? 'active' : ''} ${isActiveLargeFont ? 'active-large-font' : ''} ${props.dummy ? 'dummy' : ''}`" v-html="html"></div>
</template>
