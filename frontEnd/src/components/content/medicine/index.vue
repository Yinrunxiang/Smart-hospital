<template>
    <div>
        <div v-show="!setting" class="p-20">
            <div class="m-b-20 ovf-hd">
                <div class="fl">
                    <el-button type="info" class="" @click="addressSetting">
                        <i class="el-icon-plus"></i>&nbsp;&nbsp;Add
                    </el-button>
                    <el-button type="warning" class="" @click="deleteBtn">
                        <i class="el-icon-minus"></i>&nbsp;&nbsp;Delete
                    </el-button>
                </div>
                <div class="fl w-300 m-l-30">
                    <el-input placeholder="Please enter the model" v-model="keywords">
                        <el-button slot="append" icon="search" @click="search()"></el-button>
                    </el-input>
                </div>
            </div>
            <el-table :data="tableData" style="width: 100%" @selection-change="selectItem" @row-dblclick="rowDblclick">
                <el-table-column type="selection" width="50">
                </el-table-column>
                <el-table-column label="Name" prop="name" width="150">
                </el-table-column>
                <el-table-column label="Sex" prop="sex" width="150">
                </el-table-column>
                <el-table-column label="Age" prop="age" width="150">
                </el-table-column>
                <el-table-column label="Title" prop="title" width="150">
                </el-table-column>
                <el-table-column label="Tel" prop="tel" >
                </el-table-column>
            </el-table>
            <div class="pos-rel p-t-20">
                <div>
                    <!-- <el-button size="small" type="success" @click="setStatusBtn('enabled')">Enabled</el-button>
                    <el-button size="small" type="warning" @click="setStatusBtn('disabled')">Disabled</el-button>
                    <el-button size="small" type="danger" @click="deleteBtn()">Delete</el-button> -->
                </div>
                <div class="block pages">
                    <el-pagination @current-change="handleCurrentChange" layout="prev, pager, next" :page-size="limit" :current-page="currentPage" :total="dataCount">
                    </el-pagination>
                </div>
            </div>
        </div>
        <div v-if="setting">
            <add :add="add" :selectData="selectData" @goback="goback"></add>
        </div>
    </div>
</template>

<script>
import http from "../../../assets/js/http";
import list from "../../../assets/js/list";
import add from "./add";
export default {
  //  currentPage        页码
  //  keywords           关键字
  //  multipleSelection  被选中的数据
  //  limit              每页最大行数
  data() {
    return {
      tableData: [],
      selectData:{},
      dataCount: null,
      currentPage: null,
      keywords: "",
      multipleSelection: [],
      limit: 15,
      add: true,
      setting: false,
      selectData: {}
    };
  },
  methods: {
    goback(bool) {
      this.setting = bool;
    },
    addressSetting() {
      this.add = true;
      this.setting = true;
      var data = {
        name: "",
        sex: "",
        age: "",
        title: "",
        tel: "",
      };
      this.selectData = data;
    },
    rowDblclick(row) {
      this.add = false;
      this.setting = true;
      this.selectData = row;
    },
    //获取被选中的数据
    selectItem(val) {
      this.multipleSelection = val;
    },
    //保存状态点击事件
    setStatusBtn(status) {
      const data = {
        params: {
          selections: this.multipleSelection,
          status: status
        }
      };
      this.apiGet("device/address.php?action=setStatus", data).then(res => {
        if (res[0]) {
          for (var selection of this.multipleSelection) {
            selection.status = status;
          }
          _g.toastMsg("success", res[1]);
        } else {
          _g.toastMsg("error", res[1]);
        }
      });
    },
    //删除按钮事件
    deleteBtn() {
      this.$confirm("Are you sure to delete the selected data?", "Tips", {
        confirmButtonText: "Yse",
        cancelButtonText: "No",
        type: "warning"
      })
        .then(() => {
          const data = {
            params: {
              selections: this.multipleSelection
            }
          };
          this.apiDelete("device/address.php?action=delete", data).then(res => {
            if (res[0]) {
              var address = this.$store.state.address;
              for (var i = 0; i < address.length; i++) {
                for (var selection of this.multipleSelection) {
                  if (address[i].address == selection.address) {
                    address.splice(i, 1);
                  }
                }
              }
              this.$store.dispatch("setAddress", address);
              _g.toastMsg("success", res[1]);
            } else {
              _g.toastMsg("error", res[1]);
            }
          });
        })
        .catch(() => {
          // catch error
        });
    },
    getAllData() {
      const data = {
        params: {
          keywords: this.keywords,
          page:this.currentPage,
          limit:this.limit
        }
      };
      this.apiGet("admin/doctor", data).then(res => {
        if (res.code == 200) {
          this.tableData = res.data.list
          this.dataCount = res.data.dataCount
          // this.$store.dispatch("setAddress", address);
          // _g.toastMsg("success", res[1]);
        } else {
          // _g.toastMsg("error", res[1]);
        }
      });
    },
    //初始化时统一加载
    init() {
      this.getKeywords();
      this.getCurrentPage();
      this.getAllData();
    },
  },
  created() {
    console.log("doctor");
    this.init();
  },
  components: {
    add
  },
  computed: {},
  watch: {
    $route(to, from) {
      this.init();
    }
  },
  mixins: [http, list]
};
</script>