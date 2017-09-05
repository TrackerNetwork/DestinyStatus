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