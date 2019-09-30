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
        <!-- Modal JOF Details End -->


<!-- Modal JOF Details -->
        <v-dialog v-model="jof_form">
      <v-btn color="primary" @click.native="print">Print</v-btn>
        <div class="container-fluid" id="printjof">
        <div class="card">
            <div class="card-header">
              Order Details
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 order-no">
                        </div>
                        <div class="col-6 jof-no-div">
                            <div><span class="jof-no">JOF#: {{detailItems.jofno}}</span></div>
                            <div><span class="due-date">Due Date : {{detailItems.due_date}}</span></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2 order-details">
                            <div>Distributor: </div> 
                            <div>Customer Name:</div> 
                            <div>Order Name:</div> 
                        </div>
                        <div class="col-4 order-details">
                            <div>{{detailItems.distributor_name}}</div>
                            <div>{{detailItems.customer_name}}</div>
                            <div>{{detailItems.orderno}}</div>

                        </div>
                        <div class="col-2 order-details">
                            <div>Date Prepared: </div> 
                            <div>Due Date:</div> 
                            <div>Prepared By:</div> 
                        </div>
                        <div class="col-4 order-details">
                            <div>{{detailItems.date_prepared}}</div>
                            <div>{{detailItems.due_date}}</div>
                            <div>{{detailItems.created_by}}</div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2 order-details">
                            <div>Kind : </div> 
                        </div>
                        <div class="col-4 order-details">
                            <div>{{detailItems.kind_of_ring}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 ring-details">
                            <div>Metal :</div> 
                            <div>Ring Size :</div> 
                            <div>Year :</div> 
                            <div>Karat :</div> 
                            <div>Text Style :</div> 
                        </div>
                        <div class="col-4 ring-details">
                            <div>{{detailItems.metal}}</div>
                            <div>{{detailItems.ring_size}}</div>
                            <div>{{detailItems.year}}</div>
                            <div>{{detailItems.karat}}</div>
                            <div>{{detailItems.text_style}}</div>
                        </div>
                        <div class="col-2 ring-details">
                            <div>Stone : </div> 
                            <div>Weight :</div> 
                            <div>Oxidation :</div>
                            <div>Inside Engrave :</div>
                        </div>
                        <div class="col-4 ring-details">
                            <div>{{detailItems.stone}}</div>
                            <div>{{detailItems.weight}}</div>
                            <div>{{detailItems.oxidation}}</div>
                            <div>{{detailItems.inside_engrave}}</div>
                        </div>
                    </div>
                    <br>
                    <div class="row shank-details-hdr">
                        <div class="col shanks-details">
                         Left Shank
                        </div>
                        <div class="col shanks-details">
                         Top Details
                        </div>
                        <div class="col shanks-details">
                         Right Shank
                        </div>
                    </div>
                    <div class="row shank-details-body">
                        <div class="col shanks-details">
                        {{detailItems.left_shank}}
                        </div>
                        <div class="col shanks-details">
                         {{detailItems.top_shank}}
                        </div>
                        <div class="col shanks-details">
                         {{detailItems.right_shank}}
                        </div>
                    </div>
                    <br>
                    <div class="row ring-att">
                        <div class="col remarks">Remarks: See Attach Artwork</div>
                    </div>
                    <div class="row ring-attachment">
                        <div class="col-2"></div>
                        <div class="col-8 ring-img"><img src="https://www.brianwhiter.com.au/wp-content/uploads/2017/10/Forest-1200x500-c-default.jpg" class="img-fluid" alt="Ring Image"></div>
                        <div class="col-2"></div>
                    </div>
                    <br><br>
                    <div class="row foot-remarks">
                        <div class="col">
                            <div>Receiving</div>
                            <div>Mould</div>
                            <div>Plastic</div>
                            <div>Metal</div>
                            <div>Wax</div>
                            <div>Treeing</div>
                            <div>Casting</div>
                        </div>
                        <div class="col">
                            <div>Smithing</div>
                            <div>Pre-Polishing</div>
                            <div>Stone Setting</div>
                            <div>Final Polish</div>
                            <div>Finishing</div>
                            <div>Dispatching</div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
        </v-dialog>
        <!-- Modal JOF Details End -->


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
            <v-chip v-on:click="openJOF(item)">View JOF</v-chip> 
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
      jof_form: false,
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
        console.log(this.detailItems.jofno)
      },
      openJOF(item) {
        this.jof_form = true
        this.detailItems = item
      },
      print(){
        const prtHtml = document.getElementById('printjof').innerHTML;

        // Get all stylesheets HTML
        let stylesHtml = '';
        for (const node of [...document.querySelectorAll('link[rel="stylesheet"], style')]) {
        stylesHtml += node.outerHTML;
        }

        // Open the print window
        const WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');

        WinPrint.document.write(`<!DOCTYPE html>
        <html>
        <head>
            ${stylesHtml}
        </head>
        <body>
            ${prtHtml}
        </body>
        </html>`);

        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
      }
    },
   
   
    
  }
</script>