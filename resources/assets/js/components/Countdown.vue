<template>
    <div class="text-center">
        <Countdown deadline="weekly"></Countdown>
    </div>
</template>
<script>
    import Countdown from 'vuejs-countdown'

    export default {
        props: ['weekly'],
        components: { Countdown },
    }
</script>