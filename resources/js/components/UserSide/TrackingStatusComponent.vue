<style lang="scss" scoped>
.chip{
  background: #ffffff5e !important; 
}
button.my-12.v-btn.v-btn--contained.theme--dark.v-size--large.blue.lighten-2 {
    top: 5px;
}
</style>

<template>
<div>
     <v-app light>
    <v-toolbar color="white">
      <v-toolbar-title v-text="title"></v-toolbar-title>
    </v-toolbar>
    <v-content>
      <section>
        <v-parallax src="img/hero.jpeg" height="600">
          <v-layout
            column
            align-center
            justify-center
            class="white--text"
          >
            <img src="img/vy-logo-main.png" alt="VY DOMINGO" height="200">
            <h1 class="white--text mb-2 display-1 text-center">VY DOMINGO JEWELLERS</h1>
            <div class="subheading mb-4 text-center">• MANUFACTURER • WHOLESALER • DESIGNER</div>

           
          </v-layout>
          <div class="container">
            <div class="row">
              <div class="col">
              </div>
              <div class="col-5">
                <v-text-field v-model="trackcode"  class="my-12" label="Type your Tracking no / Order Code" outlined dark></v-text-field>
              </div>
              <div class="col">
                 <v-btn
                     class="my-12"
                      color="blue lighten-2"
                      dark
                      large
                      @click='searchurl()'
                    >
                      Search
                    </v-btn>
              </div>
            </div>
          </div>
        </v-parallax>
      </section>

      <section>
        <v-layout
          column
          wrap
          class="my-12"
        >
          <v-flex xs12 sm4 class="my-4">
            <div class="text-center">
              <h2 class="headline">GET UPDATES ON YOUR ORDERS!</h2>
            </div>
          </v-flex>
          <v-flex xs12 md12>
              <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >>
                      <template v-slot:item.jof_status="{ item }" > 
                        <v-chip class="chip" v-if="item.jof_status == 'Receiving Section'"> ORDERED RECEIVED</v-chip> 
                        <v-chip class="chip" v-else-if="item.jof_status == 'Mold Section'|| item.jof_status == 'Casting Section' || item.jof_status == 'Stone Section' || item.jof_status == 'Finishing Section'" >PROCESSING</v-chip> 
                        <v-chip class="chip" v-else-if="item.jof_status == 'DONE'" >FOR DELIVERY</v-chip> 
                    </template>
              </v-data-table>
          </v-flex>
          <v-flex xs12 >
            <v-container grid-list-xl>
              <v-layout row wrap align-center>
                <v-flex xs12 md12>
                  <v-card flat class="transparent">
                    <v-card-text class="text-center">
                      <v-icon x-large class="blue--text text--lighten-2">mdi-flash</v-icon>
                    </v-card-text>
                    <v-card-title primary-title class="layout justify-center">
                      <div class="headline">WELCOME TO V.Y.DOMINGO JEWELLERS INCORPORATED.</div>
                    </v-card-title>
                    <v-card-text>
                              WORLD FAMOUS FOR CUSTOMIZED AND PERSONALIZED JEWELRY.
                              WE ARE THE LARGEST MANUFACTURER ,SUPPLIER AND EXPORTER OF CLASS RINGS, MILITARY RINGS, CORPORATE AWARD JEWELRY,
                              NAME JEWELRY AND CHAMPIONSHIP/SPORTS RINGS FROM THE PHILIPPINES TO THE WHOLE WORLD.
                              OUR EXCELLENT WORKMANSHIP IS THE TRADEMARK OF TRULY SUCCESSFUL INTERNATIONAL JEWELRY BRANDS WORLDWIDE.
                              OUR PIECES ARE CAREFULLY HANDCRAFTED WITH MASTERPIECES PRODUCED BY OUR ARTISANS AND DESIGNERS.
                              LOWEST PRICING – DIRECT MANUFACTURER PRICES
                              AND BEST QUALITY ASSURANCE !
                              QUALITY AND SERVICE IS OUR MISSION !
                              CUSTOMER SATISFACTION IS OUR GOAL!
                    </v-card-text>
                  </v-card>
                </v-flex>
              </v-layout>
            </v-container>
          </v-flex>
        </v-layout>
      </section>
    </v-content>
  </v-app>
 </div>
</template>

<script>
export default {
  data () {
      return {
          title: '',
          trackcode:'',
          search: '',
          headers:[
            { text: 'Tracking No', value: 'refno',  },
            { text: 'Order Code', value: 'distributor_code',  },
            { text: 'Ordered Product', value: 'kind_of_ring',  },
            { text: 'Date Prepared', value: 'date_prepared',  },
            { text: 'Due Date', value: 'due_date',  },
            { text: 'JOF Status', value: 'jof_status', },
          ],
          dataItems:[]
      }
    },
  methods:{
    searchurl(){
        axios.get('/getTracking/'+this.trackcode)
          .then((response)=>{
                this.dataItems =  response.data
          })
    }

  },
 
}
</script>
