<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form
                    id="app"
                    @submit="checkForm"
                    method="get"
                    novalidate="true">
<h2> Please If You Have flight number</h2>
                    <div class="input-group mb-3">
                        <input type="text" id="flight_number" name="flight_number" v-model="flight_number" class="form-control" placeholder="Flight Number">
                    </div>

                    <input type="submit" value="Submit">
                </form>
                <hr>

                    <span id="data" v-for="flight in flights['data']">
                       <h5>Departure Airport:  {{ flight.departure.airport }}</h5>
                       <h5>Flight Date : {{ flight.flight_date }}</h5>
                       <h5>Arrival Airport : {{ flight.arrival.airport }}</h5>
                       <h5>Airline : {{ flight.airline.name }}</h5>
                        <hr>
                    </span>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            flights: [],
            errors: [],
            flight_number: null,

        }
    },
    mounted() {
        this.loadFlights();
    },
    methods: {
        loadFlights: function () {
            axios.get('/api/v1/flights')
                .then(response => {
                    this.flights = response.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                })
        },
        checkForm: function () {
            axios.get('/api/v1/flights?flight_number='+this.flight_number)
                .then(response => {
                    this.flights = response.data.data;
                })
                .catch(function (error) {
                    console.log(error)
                })
        }
    }
}
</script>
