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
            <li v-for="(item , index) in items" :class="{active:activeClass(index)}"
                @mousedown="hit" @mousemove="setActive(index)">
                <a v-html="highlighting(item, vue)"></a>
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
    import axios from 'axios'

    export default {
        name: 'Autocomplete',
        props: {
            selectFirst: {
                require: false,
                type: Boolean,
                default: false
            },
            queryParamName: {
                require: false,
                type: String,
                default: ':keyword'
            },
            minChars: {
                require: false,
                type: Number,
                default: 2
            },
            src: {
                require: true,
                type: String,
                default: "/search/autocomplete?query=:keyword"
            },
            delayTime: {
                require: false,
                default: 500,
                type: Number
            },
            value: {
                require: true,
                type: String
            },
            fetch: {
                require: false,
                type: Function,
                default: function (url) {
                    return axios.get(url)
                }
            }
        },
        data() {
            return {
                items: [],
                query: '',
                current: -1,
                loading: false,
                lastTime: 0,
            }
        },
        methods: {
            getResponse: function (response) {
                return response.data;
            },
            onHit: function (item, vue) {
                vue.query = item

            },
            highlighting: function (item, vue) {
                return item.toString().replace(vue.query, `<b>${vue.query}</b>`)
            },
            render: function (items, vue) {
                if (_.includes(_.mapValues(items, _.method('toLowerCase')), vue.query)) {
                    return [...items];
                } else {
                    return [vue.query, ...items];
                }
            },
            update(event) {
                this.lastTime = event.timeStamp;
                if (!this.query) {
                    return this.reset()
                }

                if (this.minChars && this.query.length < this.minChars) {
                    return
                }
                setTimeout(() => {
                    if (this.lastTime - event.timeStamp === 0) {
                        this.loading = true;

                        this.fetch(this.src.replace(this.queryParamName, this.query)).then((response) => {
                            if (this.query) {
                                let data = this.getResponse(response);
                                this.items = this.render(data);

                                this.current = -1;
                                this.loading = false;

                                if (this.selectFirst) {
                                    this.down()
                                }
                            }
                        })
                    }
                }, this.delayTime)
            },

            setActive(index) {
                this.current = index
            },

            activeClass(index) {
                return this.current === index
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

            reset: function () {
                this.items = [];
                this.loading = false
            }

        },
        watch: {
            value: function (value) {
                this.query = this.query !== value ? value : this.query
            },
            query: function (value) {
                this.$emit('input', value)
            }
        },
        computed: {
            vue: function () {
                return this
            },
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
