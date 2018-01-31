<template>
  <div>
    <el-menu default-active="1" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" theme="dark" @select="routerChange">
      <el-menu-item index="user">
        <i class="el-icon-menu"></i>User</el-menu-item>
      <el-menu-item index="department">
        <i class="el-icon-menu"></i>Department</el-menu-item>
      <el-menu-item index="doctor">
        <i class="el-icon-menu"></i>Doctor</el-menu-item>
      <el-menu-item index="nurse">
          <i class="el-icon-menu"></i>Nurse
      </el-menu-item>
      <el-menu-item index="patient">
        <i class="el-icon-menu"></i>Patient</el-menu-item>
      <el-menu-item index="medicine">
        <i class="el-icon-menu"></i>Medicine</el-menu-item>
      <el-menu-item index="disease">
        <i class="el-icon-menu"></i>Disease</el-menu-item>
      <el-menu-item index="record">
        <i class="el-icon-menu"></i>Record</el-menu-item>
    </el-menu>
  </div>
</template>

<style>
.badge-div {
  position: relative;
  width: 100%;
  height: 100%;
}

.badge-div sup {
  position: absolute !important;
  top: 15px !important;
  right: 10px !important;
}
</style>


<script>
export default {
  data() {
    return {
      menuDatas: [
        {
          title: "User",
          url: "/home/user",
          name: "user"
        },
        {
          title: "Department",
          url: "/home/department",
          name: "department"
        },
        {
          title: "Doctor",
          url: "/home/doctor",
          name: "doctor"
        },
        {
          title: "Nurse",
          url: "/home/nurse",
          name: "nurse"
        },
        {
          title: "Patient",
          url: "/home/patient",
          name: "patient"
        },
        {
          title: "Medicine",
          url: "/home/medicine",
          name: "medicine"
        },
        {
          title: "Disease",
          url: "/home/disease",
          name: "disease"
        },
        {
          title: "Record",
          url: "/home/record",
          name: "record"
        }
      ]
    };
  },
  props: ["menuData"],
  methods: {
    handleOpen(key, keyPath) {
      // console.log(key, keyPath);
    },
    handleClose(key, keyPath) {
      // console.log(key, keyPath);
    },
    routerChange(key, keyPath) {
      for (var item of this.menuDatas) {
        if (key == item.name) {
          if (item.url != this.$route.path) {
            router.push(item.url);
          } else {
            _g.shallowRefresh(this.$route.name);
          }
        }
      }
    }
  },
  created() {
    console.log("leftmeun");
  },
  computed: {
    //获取异常设备
    deviceWarn() {
      // var warn = 0
      // for (var device of this.$store.state.devices) {
      //   if (device.on_off == 'on') {
      //     for (var breed of this.$store.state[device.devicetype + "_breed"]) {
      //       var run_time = parseInt(breed.run_time) * 36000
      //       if (device.breed == breed.breed && device.run_time >= run_time) {
      //         warn += 1
      //       }
      //     }
      //   }
      // }
      var warn = this.$store.state.warn;
      return warn;
    }
  }
};
</script>