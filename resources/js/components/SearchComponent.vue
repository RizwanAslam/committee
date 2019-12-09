<template>
    <div class="container">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Start Date:</label>
                        <datepicker :bootstrap-styling="true" name="start_date" :format="customFormatter"
                                    id="start_date" v-model="fields.start_date">
                        </datepicker>
                        <div class="help-block form-text text-muted form-control-feedback">
                            Pick From Calender
                        </div>
                        <div v-if="errors && errors.start_date" class="text-danger">{{ errors.start_date[0] }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>End Date:</label>
                        <datepicker :bootstrap-styling="true" name="end_date" :format="customFormatter"
                                    id="end_date" v-model="fields.end_date">
                        </datepicker>
                        <div class="help-block form-text text-muted form-control-feedback">
                            Pick From Calender
                        </div>
                        <div v-if="errors && errors.end_date" class="text-danger">{{ errors.end_date[0] }}</div>
                    </div>
                </div>
            </div>
            <div class="">
                <button class="btn btn-primary" v-bind:class="{ loader: isActive}"
                        type="button" @click="submitForm">Search
                </button>
            </div>
        </form>

        <br>
        <div>
            <div class="table-responsive">
                <table id="search-datatable" width="100%"
                       class="table table-striped table-lightfont">
                    <thead>
                    <tr>
                        <!--<th>Committee Name</th>-->
                        <!--<th>Total Members</th>-->
                        <!--<th>Duration</th>-->
                        <!--<th>Start Date</th>-->
                        <!--<th>End Date</th>-->
                    </tr>
                    </thead>
                    <tbody>

                    <v-client-table :data="results" :options="options"
                                    :columns="['name', 'total_members', 'duration', 'start_date', 'end_date']">
                        <div slot="name" slot-scope="props">
                            <a :href="'/committee-reports/' + props.row.id"
                               class="btn btn-icon btn-neutral btn-icon-mini">{{props.row.name}}</a>
                        </div>
                        <div slot="start_date" slot-scope="props">
                            {{customFormatter(props.row.start_date)}}
                        </div>
                        <div slot="end_date" slot-scope="props">
                            {{customFormatter(props.row.end_date)}}
                        </div>
                    </v-client-table>


                    <!--<tr v-if="results.length > 0" v-for="result in results">-->
                    <!--<td><a :href="'/committee-reports/'+result.id">{{result.name}}</a></td>-->
                    <!--<td>{{result.total_members}}</td>-->
                    <!--<td>{{result.duration}} months</td>-->
                    <!--<td>{{result.start_date}}</td>-->
                    <!--<td>{{result.end_date}}</td>-->
                    <!--</tr>-->
                    <!--<tr v-if="results.length == 0">-->
                    <!--<td colspan="5" align="center">-->
                    <!--<h5 v-html="notFound"></h5>-->
                    <!--</td>-->
                    <!--</tr>-->
                    </tbody>
                </table>
            </div>
        </div>


    </div>


</template>

<script>
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {
            Datepicker
        },
        mounted() {

        },
        data() {
            return {
                fields: {
                    start_date: '',
                    end_date: '',
                },
                results: [],
                notFound: '',
                errors: {},
                isActive: false,
                url: '/committee-reports',
                columns: [''],
                options: {
                    perPage: 10,
                    setLimit: 10,
                },
            }
        },
        methods: {
            customFormatter(date) {
                return moment(date).format('MM/DD/YYYY');
            },

            submitForm() {
                this.errors = {};
                this.isActive = true;
                let _self = this;
                axios.post('/committee-reports', this.fields)
                    .then(response => {
                        _self.results = response.data;
                        _self.isActive = false;
                        if (_self.results == 0) {
                            _self.notFound = 'No data found..!';
                            _self.isActive = false;
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            _self.errors = error.response.data.errors || {};
                            _self.isActive = false;
                        }
                    });
            },
        }
    }
</script>
<style>
    .VueTables {
        float: left;
        margin: -1% 0 30px 0;
        padding: 5px 0 0 0;
        width: 100%;
    }

    .VueTables__search-field {
        position: relative;
        left: 670px;
        display: flex;
        top: 25px;
    }

    .VueTables__search__input {
        margin: 5px;
    }


    .loader {
        color: transparent !important;
        pointer-events: none;
        position: relative;
    }

    .loader:after {
        animation: spinAround 500ms infinite linear;
        border: 2px solid #f9f9f9;
        border-radius: 9px;
        border-right-color: transparent;
        border-top-color: transparent;
        content: "";
        display: block;
        width: 16px;
        height: 16px;
        position: absolute;
        left: calc(50% - (1em / 2));
        top: calc(50% - (1em / 2));
    }

    @-webkit-keyframes spinAround {
        from {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
        }
    }

    @keyframes spinAround {
        from {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
        }
    }
</style>
