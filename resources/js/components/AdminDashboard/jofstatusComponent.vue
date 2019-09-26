<style scoped>
.theme--light.v-data-table {
    background-color: #fff;
    color: rgba(0,0,0,.87);
    margin: 10px;
}
.textpads{
    padding: 5px;
    color: white;
    margin: 5px 10px;
}
.bg-warning{
  color:black !important;
}
.v_img{
  cursor: pointer !important;
}
.file-upload-form, .image-preview {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    padding: 20px;
}
img.preview {
    width: 200px;
    background-color: white;
    border: 1px solid #DDD;
    padding: 5px;
}
.image-preview {
    width: 100%;
    max-width: 600px;
    margin: auto;
}

.trans{
  -webkit-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Safari 4+ */
  -moz-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Fx 5+ */
  -o-animation: NAME-YOUR-ANIMATION 1s infinite;  /* Opera 12+ */
  animation: NAME-YOUR-ANIMATION 1s infinite;  /* IE 10+, Fx 29+ */
}

@keyframes NAME-YOUR-ANIMATION {
  0%, 49% {
    background-color: transparent;
    /* border: 3px solid #e50000; */
  }
  50%, 100% {
    background-color: #e50000;
  }
}

.radiOPTS {
    margin-left: 10px;
}

</style>


<template>
<div>
      <v-toolbar flat color="white">
        <v-toolbar-title>JOF Status</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      <v-spacer></v-spacer>
      <!-- Modal Tracking -->
      <v-dialog v-model="tracking">
            <v-data-table :headers="trackingHeader" :items="trackingItems" class="elevation-1" loading="true">
            </v-data-table>
        </v-dialog>
      <!-- Modal JOF Details -->
        <v-dialog v-model="details">
              <v-card>
              <v-card-title>
                <span class="headline">JOF Details</span>
                <v-flex xs11></v-flex>
                <v-btn color="primary" dark class="mb-2">PRINT</v-btn>
              </v-card-title>
              

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                   <v-flex xs12>Kind of Ring: <label>{{detailItems.kind_of_ring}}</label></v-flex>
                   <v-flex xs6>Metal: <label>{{detailItems.metal}}</label></v-flex>
                    <v-flex xs6>Stone: <label>{{detailItems.stone}}</label></v-flex>
                    <v-flex xs6>Ring Size: <label>{{detailItems.ring_size}}</label></v-flex>
                    <v-flex xs6>Bridge: <label>{{detailItems.bridge}}</label></v-flex>
                    <v-flex xs6>Year: <label>{{detailItems.year}}</label></v-flex>
                    <v-flex xs6>Weight: <label>{{detailItems.weight}}</label></v-flex>
                    <v-flex xs6>Karat: <label>{{detailItems.karat}}</label></v-flex>
                    <v-flex xs6>Oxidation: <label>{{detailItems.oxidation}}</label></v-flex>
                    <v-flex xs6>Text Style: <label>{{detailItems.text_style}}</label></v-flex>
                    <v-flex xs6>Inside Engrave: <label>{{detailItems.inside_engrave}}</label></v-flex>
                    <v-flex xs6>Quantity: <label>{{detailItems.quantity}}</label></v-flex>
                   <!-- Shanks -->
                    <v-flex xs12>
                      <v-card>
                        <v-card-title>
                            <span class="headline">Shanks</span>
                          </v-card-title>
                          <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs4><label>LEFT SHANK</label></v-flex>
                                    <v-flex xs4><label>TOP SHANK</label></v-flex>
                                    <v-flex xs4><label>RIGHT SHANK</label></v-flex>
                                     <v-flex xs4><label>{{detailItems.left_shank}}</label></v-flex>
                                    <v-flex xs4><label>{{detailItems.top_shank}}</label></v-flex>
                                    <v-flex xs4><label>{{detailItems.right_shank}}</label></v-flex>
                                </v-layout>
                            </v-container>
                          </v-card-text>
                      </v-card>
                    </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-data-table :headers="headers" :items="dataItems" :search="search" class="elevation-1" >
        <template v-slot:top>
          <div class="radiOPTS">
            <input type="radio" name="optradio" v-on:click="displayData('All')" :checked='radiobtns.pending'><label class=' bg-primary textpads'>Pending JOF Order</label>
            <input type="radio" name="optradio" v-on:click="displayData('Done')" :checked='radiobtns.delivered'> <label class='bg-success textpads'>Done</label>
          </div>
        </template>
          <template v-slot:item.due_date="{ item }" > 
            <v-chip v-if="item.jof_status == 'Done'"> {{ item.due_date }}</v-chip> 
            <v-chip v-if="item.jof_status != 'Done'"  :class="getColor(item.due_date)" > {{ item.due_date }}</v-chip> 
        </template>
         <template v-slot:item.view_details="{ item }" > 
            <v-chip v-on:click="getDetails(item)">View Details</v-chip> 
        </template>
         <template v-slot:item.jofaction="{ item }">
          <v-chip v-on:click="getJOFhistory(item)"> JOF HISTORY</v-chip> 
        </template>
         
  </v-data-table>
  </div>
</template>

<script>
  export default {
    data: () => ({
      search: '',
      tracking:false,
      details:false,
      headers: [
        { text: 'JOF#', value: 'jofno',  },
        { text: 'Order#', value: 'orderno',  },
        { text: 'Distributor Name', value: 'distributor_name',  },
        { text: 'Customer Name', value: 'customer_name',  },
        { text: 'Date Prepared', value: 'date_prepared',  },
        { text: 'Due Date', value: 'due_date',  },
        { text: 'JOF Status', value: 'jof_status', },
        { text: 'View Details', value: 'view_details', },
        { text: 'JOF History',value: 'jofaction', sortable: false },

      ],
      trackingHeader:[
        { text: 'JOF#', value: 'jofno',  },
        { text: 'Kind of Ring', value: 'kind_of_ring',  },
        { text: 'Event Date', value: 'event_time',  },
        { text: 'JOF Status', value: 'jof_status', },
      ],
      dataItems:[],
      detailItems:[],
      trackingItems:[],
      jofData:{
          Delivered:[],
          Pending:[],
      },
      radiobtns:{
        pending:true,
        delivered:false
      }
    }),
    
    computed: {
   
    },
      dialog (val) {
        val || this.close()
      },

    async mounted(){
          axios.get('/api/JOFPending')
          .then((response)=>{
                this.jofData.Pending = response.data
                this.dataItems =  response.data
          })
           axios.get('/api/JOFDelivered')
          .then((response)=>{
                this.jofData.Delivered = response.data
          })
          setInterval(function(){
            this.liveReload()
          }.bind(this), 5000);
    },
 
//methods

    methods: {
       getColor (a) {
           const duedate = new Date(a),
            datenow =  new Date(new Date().getTime()+(120*24*7*59*1000)).toISOString().substr(0, 10)

        if (new Date(datenow) > duedate) return 'trans'
        else return 'none'
        // else return 'green'
      },

        displayData(a){
        //radio button when clicked. shows only data needed
        switch(a){
          case 'Done':
              this.radiobtns.delivered = true
              this.radiobtns.pending = false
              this.dataItems = this.jofData.Delivered
            break;
          case 'All':
              this.radiobtns.pending = true
              this.radiobtns.delivered = false
              this.dataItems = this.jofData.Pending
            break;
        }

      },
      liveReload(){
          axios.get('/api/JOFPending')
          .then((response)=>{
                this.jofData.Pending = response.data
                 if(this.radiobtns.pending == true){
                  this.dataItems = response.data
                }
          })
           axios.get('/api/JOFDelivered')
          .then((response)=>{
                this.jofData.Delivered = response.data
                if(this.radiobtns.delivered == true){
                this.dataItems = response.data
                 }
          })
      
      },
      getJOFhistory(item){
        this.tracking = true
            axios.get('/api/getJOF/'+item.id)
          .then((response)=>{
                this.trackingItems = response.data
          })
      },
      getDetails(item){
        this.details=true
        this.detailItems = item
      }

    },
   
   
    
  }
</script>