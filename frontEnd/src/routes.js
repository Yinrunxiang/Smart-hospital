import refresh from "./components/refresh.vue";
import Login from './components/Account/Login.vue'
import Home from "./components/Home.vue";
import user from "./components/content/user/index.vue";
import userAdd from "./components/content/user/add.vue";
import department from "./components/content/department/index.vue";
import departmentAdd from "./components/content/department/add.vue";
import doctor from "./components/content/doctor/index.vue";
import doctorAdd from "./components/content/doctor/add.vue";
import nurse from "./components/content/nurse/index.vue";
import nurseAdd from "./components/content/nurse/add.vue";
import patient from "./components/content/patient/index.vue";
import patientAdd from "./components/content/patient/add.vue";
import medicine from "./components/content/medicine/index.vue";
import medicineAdd from "./components/content/medicine/add.vue";
import disease from "./components/content/disease/index.vue";
import diseaseAdd from "./components/content/disease/add.vue";
import record from "./components/content/record/index.vue";
/**
 * meta参数解析
 * hideLeft: 是否隐藏左侧菜单，单页菜单为true
 * module: 菜单所属模块
 * menu: 所属菜单，用于判断三级菜单是否显示高亮，如菜单列表、添加菜单、编辑菜单都是'menu'，用户列表、添加用户、编辑用户都是'user'，如此类推
 */

const routes = [
  { path: '/', component: Home, name: 'home' },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "user", component: user, name: "user" },
      { path: "user/add", component: userAdd, name: "userAdd" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "department", component: department, name: "department" },
      { path: "department/add", component: departmentAdd, name: "departmentAdd" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "doctor", component: doctor, name: "doctor" },
      { path: "doctor/add", component: doctorAdd, name: "doctorAdd" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "refresh", component: refresh, name: "refresh" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "nurse", component: nurse, name: "nurse" },
      { path: "nurse/add", component: nurseAdd, name: "nurseAdd" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "patient", component: patient, name: "patient" },
      { path: "patient/add", component: patientAdd, name: "patientAdd" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "medicine", component: medicine, name: "medicine" },
      { path: "medicine/add", component: medicineAdd, name: "medicineAdd" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "disease", component: disease, name: "disease" },
      { path: "disease/add", component: diseaseAdd, name: "diseaseAdd" },
    ]
  },
  {
    path: "/home",
    component: Home,
    children: [
      { path: "record", component: record, name: "record" }
    ]
  },
  { path: "/", redirect: { name: "doctor" } }
];
export default routes;
