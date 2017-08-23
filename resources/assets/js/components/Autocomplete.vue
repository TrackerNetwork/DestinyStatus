<template>
    <div class="input-group">
        <input type="text" class="form-control"
               placeholder="guardian name"
               id="gamertag"
               name="gamertag"
               autocomplete="off"
               v-model="query"
               @keydown.down="down"
               @keydown.up="up"
               @keydown.enter="hit"
               @keydown.esc="reset"
               @input="update($event)"/>
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
		</span>
        <ul v-show="hasItems" class="dropdown-menu-list dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
            <li v-for="(item , index) in items" :class="{active: current === index}"
                @mousedown="hit" @mousemove="current = index">
                <a v-html="highlighting(item, query)"></a>
            </li>
        </ul>
    </div>
</template>
<style scoped>
    .dropdown-menu-list {
        display: list-item;
        width: 100%;
    }
</style>
<script>
    import api from '../api'

    export default {
        name: 'Autocomplete',
        filters: {},
        props: {
            selectFirst: {
                require: false,
                type: Boolean,
                default: false
            },
            minChars: {
                require: false,
                type: Number,
                default: 2
            },
            value: {
                default: null
            }
        },
        data() {
            return {
                current: -1,
                delayTime: 500,
                items: [],
                lastTime: 0,
                loading: false,
                query: ''
            }
        },
        methods: {
            onHit(item, vue) {
                vue.query = item
            },
            update(event) {
                this.lastTime = event.timeStamp;
                if (!this.query) {
                    return this.reset()
                }

                if (this.query.length < this.minChars) {
                    return
                }
                setTimeout(() => {
                    if (this.lastTime - event.timeStamp === 0) {
                        this.loading = true;

                        api.search.search(this.query)
                            .then((items) => {
                                this.items = items
                                this.current = -1
                                this.loading = false
                                if (this.selectFirst) {
                                    this.down()
                                }
                            })
                    }
                }, this.delayTime)
            },
            highlighting(item, query) {
                return item.toString().replace(query, `<b>${query}</b>`)
            },

            hit() {
                if (this.current !== -1) {
                    this.onHit(this.items[this.current], this)
                }
                this.reset()
            },

            up() {
                if (this.current > 0) {
                    this.current--
                } else if (this.current === -1) {
                    this.current = this.items.length - 1
                } else {
                    this.current = -1
                }
                if (!this.selectFirst && this.current !== -1) {
                    this.onHit(this.items[this.current], this)
                }
            },

            down() {
                if (this.current < this.items.length - 1) {
                    this.current++
                } else {
                    this.current = -1
                }
                if (!this.selectFirst && this.current !== -1) {
                    this.onHit(this.items[this.current], this)
                }
            },

            reset() {
                this.items = [];
                this.loading = false
            }

        },
        computed: {
            hasItems() {
                return this.items.length > 0
            },

            isEmpty() {
                return this.query === ''
            }
        },

        mounted() {
            document.addEventListener('click', (e) => {
                if (!this.$el.contains(e.target)) {
                    this.reset()
                }
            })
        }
    }
</script>
