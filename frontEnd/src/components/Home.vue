<template>
	<el-row class="panel m-w-1280">
    <span class="version">ver 1.0.5</span>
		<el-col :span="24" class="panel-top">
			<el-col class="w-180">
				<template v-if="logo_type == '1'">
					<!-- <img :src="img" class="logo"> -->
				</template>
				<template v-else>
					<a class="p-l-10"  style="cursor:pointer"  @click="homeClick()"><img src="../assets/images/applog.png" class="logo">Smart Hospital</a>
				</template>
			</el-col>
      <el-col :span="18" class="h-60">
        <!-- <topMenu ref="topMenu"></topMenu> -->
      </el-col>
			<el-col  :span="2" class="pos-rel">
				<el-dropdown @command="handleMenu" class="user-menu">

					<p class="el-dropdown-link c-gra user-ground" style="cursor: default">
						<i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;{{username}}
					</p>
					<el-dropdown-menu slot="dropdown">
						<el-dropdown-item command="changePwd">Setting</el-dropdown-item>
						<el-dropdown-item command="logout">Sign out</el-dropdown-item>
					</el-dropdown-menu>
				</el-dropdown>
        
			</el-col>
		</el-col>
		<el-col :span="24" class="panel-center">
			<!--<el-col :span="4">-->
			<aside class="w-180 ovf-hd">
				<leftMenu :menuData="menuData" ref="leftMenu"></leftMenu>
			</aside>
			<section class="panel-c-c" :class="{'hide-leftMenu': hasChildMenu}">
				<div class="grid-content bg-purple-light">
					<el-col :span="24">
						<transition name="fade" mode="out-in" appear>
							<router-view :dataReady="dataReady"></router-view>
						</transition>
					</el-col>
				</div>
			</section>
		</el-col>
		<changePwd ref="changePwd" :showChange = 'showChange' @change = 'showChangePage'></changePwd>

	</el-row>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-active {
  opacity: 0;
}

.panel {
  position: absolute;
  top: 0px;
  bottom: 0px;
  padding: 0;
  width: 100%;
}

.panel-top {
  height: 60px;
  line-height: 60px;
  background: #1f2d3d;
  color: #c0ccda;
}

.panel-center {
  background: #324057;
  position: absolute;
  top: 60px;
  bottom: 0px;
  overflow: hidden;
}

.panel-c-c {
  background: #f1f2f7;
  position: absolute;
  right: 0px;
  top: 0px;
  bottom: 0px;
  left: 180px;
  overflow-y: auto;
  padding: 0px;
}

.logout {
  background: url(../assets/images/logout_36.png);
  background-size: contain;
  width: 20px;
  height: 20px;
  float: left;
}

.logo {
  margin: 10px 0 10px 10px;
  height: 40px;
  width: 40px;
  float: left;
  border-radius: 10px;
}
.version {
  position: absolute;
  top: 5px;
  right: 5px;
  font-size: 10px;
  color: #c0ccda;
}

.user-ground {
  margin: 0;
  padding-top: 15px;
  width: 100px;
  height: 30px;
  line-height: 30px;
}

/* .tip-logout {
	float: right;
	margin-right: 20px;
	padding-top: 5px;
	cursor: pointer;
} */

.admin {
  color: #c0ccda;
  text-align: center;
}

.hide-leftMenu {
  left: 0px;
}
</style>
<script>
import leftMenu from "./Common/leftMenu.vue";
import topMenu from "./Common/topMenu.vue";
import changePwd from "./Account/changePwd.vue";
import http from "../assets/js/http";

export default {
  data() {
    return {
      username: "",
      // topMenu: [],
      childMenu: [],
      menuData: [
        {
          title: "Global",
          url: "/home/global",
          name: "global"
        },
        {
          title: "Contral",
          url: "/home/contral",
          name: "contral"
        },
        {
          title: "plan",
          url: "/home/plan",
          name: "plan"
        },
        {
          title: "report",
          url: "/home/report",
          name: "report"
        }
      ],
      hasChildMenu: false,
      menu: null,
      module: null,
      img: "",
      title: "",
      logo_type: null,
      records: [],
      dataReady: false,
      showChange: false
    };
  },
  methods: {
    homeClick() {
      let url = "/home/global";
      router.push(url);
    },
    showChangePage(val) {
      this.showChange = val;
    },
    logout() {
      this.$confirm("Are you sure to exit?", "Warning", {
        confirmButtonText: "Yes",
        cancelButtonText: "No"
      }).then(() => {
        Lockr.rm("username");
        Lockr.rm("password");
        Lockr.rm("database_name");
        Cookies.remove("rememberPwd");
        _g.toastMsg("success", "Exit success");
        setTimeout(() => {
          router.replace("/");
        }, 1500);
      });
    },
    changePwd() {
      this.showChange = true;
    },
    handleMenu(val) {
      switch (val) {
        case "logout":
          this.logout();
          break;
        case "changePwd":
          this.changePwd();
          break;
      }
    },
    getAcBreed() {
      const data = {
        params: {
          action: "search"
        }
      };
      this.apiGet("device/ac_breed.php", data).then(res => {
        this.$store.dispatch("setAcBreed", res);
      });
    },
    getLightBreed() {
      const data = {
        params: {
          action: "search"
        }
      };
      this.apiGet("device/light_breed.php", data).then(res => {
        this.$store.dispatch("setLightBreed", res);
      });
    },
    getLedBreed() {
      const data = {
        params: {
          action: "search"
        }
      };
      this.apiGet("device/led_breed.php", data).then(res => {
        this.$store.dispatch("setLedBreed", res);
      });
    },
    getAddress() {
      const data = {
        params: {
          action: "search"
        }
      };
      this.apiGet("device/address.php", data).then(res => {
        this.$store.dispatch("setAddress", res);
      });
    },
    getFloor() {
      const data = {
        params: {
          action: "search"
        }
      };
      this.apiGet("device/floor.php", data).then(res => {
        this.$store.dispatch("setFloor", res);
      });
    },
    getRoom() {
      const data = {
        params: {
          action: "search"
        }
      };
      this.apiGet("device/room.php", data).then(res => {
        this.$store.dispatch("setRoom", res);
      });
    },
    getRecord(start, end, count, setIntervalRecord) {
      const data = {
        params: {
          action: "getrecord",
          start: start,
          end: end
        }
      };
      var vm = this;
      this.apiGet("device/index.php", data).then(res => {
        var records = res;
        var newRecords = [];
        var addresss = this.$store.state.address;
        var ac_breeds = this.$store.state.ac_breed;
        var light_breeds = this.$store.state.light_breed;
        var led_breeds = this.$store.state.led_breed;
        for (var record of records) {
          if (record.on_off == "on") {
            switch (record.devicetype) {
              case "ac":
                for (var ac_breed of ac_breeds) {
                  if (record.breed == ac_breed.breed) {
                    record.watts =
                      parseInt(ac_breed[record.mode]) +
                      parseInt(ac_breed[record.grade]);
                  }
                }
                break;
              case "light":
                for (var light_breed of light_breeds) {
                  if (record.breed == light_breed.breed) {
                    record.watts = parseInt(light_breed.watts);
                  }
                }
                break;
              case "led":
                for (var led_breed of led_breeds) {
                  if (record.breed == led_breed.breed) {
                    record.watts = parseInt(led_breed.watts);
                  }
                }
                break;
            }
            if (record.watts) {
              record.watts = parseFloat(record.watts / 1000);
              record.usd = 0;
              for (var address of addresss) {
                if (address.address == record.address && address.kw_usd) {
                  record.usd = record.watts * parseFloat(address.kw_usd);
                }
              }
              newRecords.push(record);
            }
          }
        }

        //记录数据处理完成
        //以下是记录数据的使用
        vm.records = vm.records.concat(newRecords);
        if (end >= count) {
          vm.$store.dispatch("setRecord", vm.records);
          vm.$store.dispatch("setRecordLoading", false);
          clearInterval(setIntervalRecord);
        }
      });
    },
    forGetRecord(count) {
      var i = 0,
        start = 0,
        end = 0;
      var vm = this;

      var setIntervalRecord = setInterval(function() {
        start = i + 1;
        end = i + 5000;
        i += 5000;
        vm.getRecord(start, end, count, setIntervalRecord);
      }, 1000);
    },
    getRecordCount() {
      var vm = this;
      const data = {
        params: {
          action: "getRecordCount"
        }
      };
      this.apiGet("device/index.php", data).then(res => {
        var count = parseInt(res[0].count);
        this.forGetRecord(count);
        // for(var i = 0 ;i<count;i+=2000){
        // 	var start = i + 1
        // 	var end = i + 2000
        // 	this.getRecord(start, end,count)
        // }
      });
    },
    countryArr() {
      var countryArr = [];
      var countryList = [];
      var typeList = ["light", "ac", "led"];
      for (let address of this.$store.state.address) {
        if (countryList.indexOf(address.country) == -1) {
          countryList.push(address.country);
          var mapIportCountryObject = {};
          mapIportCountryObject.name = address.country;
          mapIportCountryObject.selected = true;
          mapIportCountryObject.deviceList = [];
          mapIportCountryObject.deviceTypeNumber = {};
          mapIportCountryObject.warn = 0;
          mapIportCountryObject.watts = 0;
          mapIportCountryObject.usd = 0;
          mapIportCountryObject.addressList = [];
          for (let address2 of this.$store.state.address) {
            if (address.country == address2.country) {
              var addressObject = {};
              addressObject.name = address2.address;
              addressObject.id = address2.addressid;
              addressObject.country = address2.country;
              addressObject.address = address2.address;
              addressObject.lat = address2.lat;
              addressObject.lng = address2.lng;
              addressObject.ip = address2.ip;
              addressObject.port = address2.port;
              addressObject.mac = address2.mac;
              addressObject.floorList = [];
              addressObject.deviceList = [];
              addressObject.warn = 0;
              addressObject.watts = 0;
              addressObject.usd = 0;
              addressObject.deviceTypeNumber = {};
              for (var floor of this.$store.state.floor) {
                if (floor.address == address2.address) {
                  var floorObject = {};
                  floorObject.name = floor.floor;
                  floorObject.roomList = [];
                  floorObject.roomArr = [];
                  floorObject.deviceList = [];
                  floorObject.deviceTypeNumber = {};
                  floorObject.warn = 0;
                  floorObject.watts = 0;
                  floorObject.usd = 0;
                  for (var room of this.$store.state.room) {
                    if (
                      room.floor == floor.floor &&
                      room.address == floor.address
                    ) {
                      var roomObject = {};
                      roomObject.name = room.room;
                      roomObject.id = room.id;
                      roomObject.image = room.image;
                      roomObject.room = room.room;
                      roomObject.room_name = room.room_name;
                      roomObject.floor = room.floor;
                      roomObject.address = room.address;

                      roomObject.typeList = [];
                      roomObject.typeArr = [];
                      roomObject.deviceList = [];
                      roomObject.deviceTypeNumber = {};
                      roomObject.warn = 0;
                      roomObject.watts = 0;
                      roomObject.usd = 0;
                      // for(var type of typeList){
                      //     var typeObject = {};
                      //     typeObject.name = type;
                      //     typeObject.deviceList = [];
                      //     roomObject.typeList.push(typeObject);

                      // }
                      floorObject.roomList.push(roomObject);
                    }
                  }
                  addressObject.floorList.push(floorObject);
                }
              }
              mapIportCountryObject.addressList.push(addressObject);
            }
          }
          countryArr.push(mapIportCountryObject);
        }
      }
      // console.log(countryArr);
      var warn = 0;
      // var initAddress = this.$store.state.address
      // var initFloor = this.$store.state.floor
      // var initRoom = this.$store.state.room
      //this.devices原始设备数据
      var addresss = this.$store.state.address;
      var ac_breeds = this.$store.state.ac_breed;
      var light_breeds = this.$store.state.light_breed;
      var led_breeds = this.$store.state.led_breed;
      for (var item of this.devices) {
        item.warn = false;
        var warnDeviceList = ["light", "ac", "led"];
        if (warnDeviceList.indexOf(item.devicetype) != -1) {
          if (item.on_off == "on") {
            for (var breed of this.$store.state[item.devicetype + "_breed"]) {
              var run_time = parseInt(breed.run_time) * 36000;
              if (
                breed.run_time != 0 &&
                item.breed == breed.breed &&
                item.run_time >= run_time
              ) {
                item.warn = true;
                warn += 1;
              }
            }
          }
        }
        item.watts = 0;
        item.usd = 0;
        if (item.on_off == "on") {
          switch (item.devicetype) {
            case "ac":
              for (var ac_breed of ac_breeds) {
                if (item.breed == ac_breed.breed) {
                  item.watts =
                    parseInt(ac_breed[item.mode]) +
                    parseInt(ac_breed[item.grade]);
                }
              }
              break;
            case "light":
              for (var light_breed of light_breeds) {
                if (item.breed == light_breed.breed) {
                  item.watts = parseInt(light_breed.watts);
                }
              }
              break;
            case "led":
              for (var led_breed of led_breeds) {
                if (item.breed == led_breed.breed) {
                  item.watts = parseInt(led_breed.watts);
                }
              }
              break;
          }
          if (item.watts) {
            item.watts = parseFloat(item.watts / 1000);
            item.usd = 0;
            for (var address of addresss) {
              if (address.address == item.address && address.kw_usd) {
                item.usd = item.watts * parseFloat(address.kw_usd);
              }
            }
          }
        }
        //筛选重复国家
        // if (countryList.indexOf(item.country) == -1) {
        //   countryList.push(item.country);
        //   var mapIportCountryObject = {};
        //   mapIportCountryObject.name = item.country;
        //   mapIportCountryObject.selected = true;
        //   mapIportCountryObject.addressList = [];
        //   mapIportCountryObject.addressArr = [];
        //   mapIportCountryObject.deviceList = [];
        //   mapIportCountryObject.deviceTypeNumber = {};
        //   mapIportCountryObject.warn = 0;
        //   // mapIportCountryObject.deviceList = {}
        //   countryArr.push(mapIportCountryObject);
        // }
        for (var country of countryArr) {
          //筛选重复类型
          if (item.country == country.name) {
            // if (country.addressArr.indexOf(item.address) == -1) {
            //   country.addressArr.push(item.address);
            //   var addressObject = {};

            //   addressObject.name = item.address;
            //   addressObject.id = item.addressid;
            //   addressObject.country = item.country;
            //   addressObject.address = item.address;
            //   addressObject.lat = item.lat;
            //   addressObject.lng = item.lng;
            //   addressObject.ip = item.ip;
            //   addressObject.port = item.port;
            //   addressObject.mac = item.mac;
            //   addressObject.floorList = [];
            //   addressObject.floorArr = [];
            //   addressObject.deviceList = [];
            //   addressObject.warn = 0;
            //   // addressObject.typeList = []
            //   // addressObject.typeArr = []
            //   addressObject.deviceTypeNumber = {};
            //   //设置楼层数组长度
            //   // let floor_num = 0
            //   // for(let address of initAddress){
            //   // 	if(address.address == item.address){
            //   // 		floor_num = address.floor_num
            //   // 	}
            //   // }
            //   // addressObject.floorList = Array.apply(null, {length: floor_num});
            //   country.addressList.push(addressObject);
            // }
            country.deviceList.push(item);
            if (item.warn) {
              country.warn += 1;
            }
            if (item.watts) {
              country.watts += item.watts;
            }
            if (item.usd) {
              country.usd += item.usd;
            }
            //计算各种设备类型的数量
            country.deviceTypeNumber[item.devicetype]
              ? (country.deviceTypeNumber[item.devicetype] += 1)
              : (country.deviceTypeNumber[item.devicetype] = 1);
            for (var address of country.addressList) {
              //筛选重复类型
              if (item.address == address.name) {
                // if (address.floorArr.indexOf(item.floor) == -1) {
                //   address.floorArr.push(item.floor);
                //   var floorObject = {};
                //   floorObject.name = item.floor;
                //   floorObject.roomList = [];
                //   floorObject.roomArr = [];
                //   floorObject.deviceList = [];
                //   floorObject.deviceTypeNumber = {};
                //   floorObject.warn = 0;
                //   address.floorList.push(floorObject);
                // }
                address.deviceList.push(item);
                if (item.warn) {
                  address.warn += 1;
                }
                if (item.watts) {
                  address.watts += item.watts;
                }
                if (item.usd) {
                  address.usd += item.usd;
                }
                address.deviceTypeNumber[item.devicetype]
                  ? (address.deviceTypeNumber[item.devicetype] += 1)
                  : (address.deviceTypeNumber[item.devicetype] = 1);
                for (var floor of address.floorList) {
                  //筛选重复类型
                  if (item.floor == floor.name) {
                    // if (floor.roomArr.indexOf(item.room) == -1) {
                    //   floor.roomArr.push(item.room);
                    //   var roomObject = {};
                    //   roomObject.name = item.room;
                    //   roomObject.room_name = item.room_name;
                    //   roomObject.typeList = [];
                    //   roomObject.typeArr = [];
                    //   roomObject.deviceList = [];
                    //   roomObject.deviceTypeNumber = {};
                    //   roomObject.warn = 0;
                    //   floor.roomList.push(roomObject);
                    // }
                    floor.deviceList.push(item);
                    if (item.warn) {
                      floor.warn += 1;
                    }
                    if (item.watts) {
                      floor.watts += item.watts;
                    }
                    if (item.usd) {
                      floor.usd += item.usd;
                    }
                    floor.deviceTypeNumber[item.devicetype]
                      ? (floor.deviceTypeNumber[item.devicetype] += 1)
                      : (floor.deviceTypeNumber[item.devicetype] = 1);
                    for (var room of floor.roomList) {
                      if (item.room == room.name) {
                        if (room.typeArr.indexOf(item.devicetype) == -1) {
                          room.typeArr.push(item.devicetype);
                          var typeObject = {};
                          typeObject.name = item.devicetype;
                          typeObject.deviceList = [];
                          room.typeList.push(typeObject);
                        }
                        room.deviceList.push(item);
                        if (item.warn) {
                          room.warn += 1;
                        }
                        if (item.watts) {
                          room.watts += item.watts;
                        }
                        if (item.usd) {
                          room.usd += item.usd;
                        }
                        room.deviceTypeNumber[item.devicetype]
                          ? (room.deviceTypeNumber[item.devicetype] += 1)
                          : (room.deviceTypeNumber[item.devicetype] = 1);
                        for (var type of room.typeList) {
                          //筛选重复类型
                          if (item.devicetype == type.name) {
                            type.deviceList.push(item);
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
      // console.log(countryArr);
      this.$store.dispatch("setWarn", warn);
      this.$store.dispatch("setCountryArr", countryArr);
      this.dataReady = true;
      // return countryArr
    }
  },
  created() {
    // console.log("report");
    // let username = Lockr.get("username");
    // let password = Lockr.get("password");
    // this.username = username;
    // if (!username || !password) {
    //   _g.toastMsg("warning", "You are not logged in yet");
    //   setTimeout(() => {
    //     router.replace("/");
    //   }, 1500);
    //   return;
    // }
    // let port = Lockr.get("port");
    // var socketio = socket("http://" + document.domain + ":" + port);
    // window.socketio = socketio;
    this.$store.dispatch("setShowHotel", true);
    this.$store.dispatch("setShowFloor", false);
    this.$store.dispatch("setShowRoom", false);
  },
  mounted() {
    // this.getAcBreed();
    // this.getLightBreed();
    // this.getLedBreed();
    // this.getAddress();
    // this.getFloor();
    // this.getRoom();

    // const data = {
    //   params: {
    //     action: "search"
    //   }
    // };
    // this.apiGet("device/index.php", data).then(res => {
    //   this.$store.dispatch("setDevices", res);
    //   // var devices = [];
    //   var maxid = res[0].maxid;
    //   this.$store.dispatch("setMaxid", maxid);
    //   // for (var device of res) {
    //   //   if (device.status == "enabled") {
    //   //     devices.push(device);
    //   //   }
    //   // }
    //   // this.devices = devices
    //   this.countryArr();
    // });
    // this.getRecordCount();
  },
  components: {
    leftMenu,
    topMenu,
    changePwd
  },
  computed: {
    // devices() {
    //   return this.$store.state.devices;
    // },
    // globalLoading() {
    //   return store.state.globalLoading;
    // }
  },
  watch: {
    devices: {
      handler: function(val, oldVal) {
        this.countryArr();
      },
      deep: true
    }
  },
  mixins: [http]
};
</script>
