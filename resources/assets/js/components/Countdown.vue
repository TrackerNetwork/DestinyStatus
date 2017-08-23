<template>
    <div class="text-center">
        <Countdown deadline="September 6, 2017"></Countdown>
    </div>
</template>
<script>
    import Countdown from 'vuejs-countdown'

    export default {
        components: { Countdown }
    }
</script>
<style>
    .vue-countdown .digit {
        font-size: 65px !important;
    }
    .vue-countdown li:after {
        font-size: 61px !important;
        right: -18px !important;
    }
</style>