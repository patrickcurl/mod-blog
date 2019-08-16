# Heatmap Chart

<vue-frappe
    id="test"
    :labels="[
        '12am-3am', '3am-6am', '6am-9am', '9am-12pm',
        '12pm-3pm', '3pm-6pm', '6pm-9pm', '9pm-12am'
    ]"
    title="My Heatmap Chart"
    type="heatmap"
    :height="300"
    :colors="['purple', '#ffa3ef', 'light-blue']"
    :dataSets="this.data">
</vue-frappe>

```
<vue-frappe
    id="test"
    :labels="[
        '12am-3am', '3am-6am', '6am-9am', '9am-12pm',
        '12pm-3pm', '3pm-6pm', '6pm-9pm', '9pm-12am'
    ]"
    title="My Heatmap Chart"
    type="heatmap"
    :height="300"
    :colors="['purple', '#ffa3ef', 'light-blue']"
    :dataSets="this.data">
</vue-frappe>
```


<script>
    import Vue from 'vue'
    import Chart from './../../../src'

    Vue.use(Chart)
    export default {
        data () {
            return {
                data: {
                    dataPoints: {
                        '1524064033': 8,
                    },
                    countLabel: 'Level',
                    discreteDomains: 0,  // default: 1
                    colors: ['#ebedf0', '#c0ddf9', '#73b3f3', '#3886e1', '#17459e'],
                }
            }
        }
    }
</script>