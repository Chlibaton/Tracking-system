const sidePanel = require('./components/AdminDashboard/SidePanelComponent.vue').default;
const systemUser = require('./components/AdminDashboard/SystemUserComponent.vue').default;
const superAdmin = require('./components/AdminDashboard/SuperAdminComponent.vue').default;

// departments
const receiving = require('./components/AdminDashboard/receivingComponent.vue').default;
const mold = require('./components/AdminDashboard/moldComponent.vue').default;
const plastic = require('./components/AdminDashboard/plasticComponent.vue').default;
const wax = require('./components/AdminDashboard/waxComponent.vue').default;
const casting = require('./components/AdminDashboard/castingComponent.vue').default;
const salugar = require('./components/AdminDashboard/salugarComponent.vue').default;
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
        { path: '/plastic', name:'plastic', component: plastic, 
        meta: { 
            title: "Plastic" 
            } 
        },
        { path: '/wax', name:'wax', component: wax, 
        meta: { 
            title: "Wax" 
            } 
        },
        { path: '/casting', name:'casting', component: casting, 
        meta: { 
            title: "Casting" 
            } 
        },
        { path: '/salugar', name:'salugar', component: salugar, 
        meta: { 
            title: "Salugar" 
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