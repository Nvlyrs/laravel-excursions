<template>
    <button id="button" class="btn" aria-describedby="tooltip">I'm a button</button>
    <div id="tooltip" role="tooltip">I'm a tooltip</div>
</template>

<script>
import { createPopper } from '@popperjs/core';

const button = document.querySelector('#button');
const tooltip = document.querySelector('#tooltip');

createPopper(button, tooltip, {
    placement: 'right',
});
</script>