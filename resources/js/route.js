const sidePanel = require('./components/AdminDashboard/SidePanelComponent.vue').default;
const systemUser = require('./components/AdminDashboard/SystemUserComponent.vue').default;
const superAdmin = require('./components/AdminDashboard/SuperAdminComponent.vue').default;

// departments
const receiving = require('./components/AdminDashboard/receivingComponent.vue').default;
const mold = require('./components/AdminDashboard/moldComponent.vue').default;
const casting = require('./components/AdminDashboard/castingComponent.vue').default;
const stone = require('./components/AdminDashboard/stoneComponent.vue').default;
const finishing = require('./components/AdminDashboard/finishingComponent.vue').default;
const releasing = require('./components/AdminDashboard/releasingComponent.vue').default;

const jofstatus = require('./components/AdminDashboard/jofstatusComponent.vue').default;
const jofexport = require('./components/AdminDashboard/JOFexportComponent.vue').default;

const changepass = require('./components/UserSide/ChangePasswordComponent.vue').default;
const landingPage = require('./components/Landing/HomeComponent.vue').default;

export default{
    mode:'history',
    routes: [
        { path: '/side-panel', name:'admin', component: sidePanel, 
            meta: { 
                title: "Side Panel" 
            } 
        },
        { path: '/vy-installment', name:'home', component: landingPage, 
        meta: { 
            title: "Home Page" 
         }
        }, 
        { path: '/systemuser', name:'systemuser', component: systemUser, 
        meta: { 
            title: "System User" 
            }
        },
        { path: '/', name:'superadmin', component: superAdmin, 
        meta: { 
            title: "Dashboard" 
            } 
        },
        { path: '/receiving', name:'receiving', component: receiving, 
        meta: { 
            title: "receiving" 
            } 
        },
        { path: '/mold', name:'mold', component: mold, 
        meta: { 
            title: "Mold" 
            } 
        },
        { path: '/casting', name:'casting', component: casting, 
        meta: { 
            title: "Casting" 
            } 
        },
        { path: '/stone', name:'stone', component: stone, 
        meta: { 
            title: "Stone" 
            } 
        },
        { path: '/finishing', name:'finishing', component: finishing, 
        meta: { 
            title: "finishing" 
            } 
        },
        { path: '/releasing', name:'releasing', component: releasing, 
        meta: { 
            title: "releasing" 
            } 
        },
        { path: '/jofstatus', name:'jofstatus', component: jofstatus, 
        meta: { 
            title: "JOF Status" 
            } 
        },
        { path: '/jofexport', name:'jofexport', component: jofexport, 
        meta: { 
            title: "JOF Export" 
            } 
        },
        
    ]
}