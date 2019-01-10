<template>
  <div>
    <div class="form-group">
      <label for="weekday">Jour</label>
      <select class="form-control" id="weekday" name="weekday" v-model="daySelected">
        <option value="" disabled selected>Choisissez un jour</option>
        <option v-bind:value="now.format('L')">{{ now.format('dddd D MMMM') }}</option>
        <option v-bind:value="tomorrow.format('L')">{{ tomorrow.format('dddd D MMMM') }}</option>
      </select>
    </div>
    <div class="form-group">
      <label for="hour">Heure</label>
      <select class="form-control" id="hour" name="hour" v-if="this.selectedDay.isSame(this.now.format('L'))">
        <option value="" disabled selected>Choisissez une heure</option>
        <option 
          v-bind:value="n"
          v-for="n in range(openHour, closeHour)" 
          v-bind:key="n"
          v-if="daySelected && n > dateIncrement.format('kk')">{{ n }} heure</option>
      </select>
      <select class="form-control" id="hour" name="hour" v-else>
        <option value="" disabled selected>Choisissez une heure</option>
        <option 
          v-bind:value="n"
          v-for="n in range(openHour, closeHour)" 
          v-bind:key="n"
          v-if="daySelected">{{ n }} heure</option>        
      </select>
    </div>   
  </div>
</template>

<script>
import moment from 'moment';

moment.locale('fr');

export default {
  props: {
    openHour: String,
    closeHour: String,
    increment: String
  },

  data() {
    return {
      now: moment(),
      tomorrow: moment().add(1, 'd'),
      dateIncrement: moment().add(1, 'h'),
      daySelected: ""
    }
  },

  computed: {
    selectedDay: function () {
      console.log(this.daySelected);
      return moment(this.daySelected);
    }
  },

  methods: {
    range: function (start, end) {
      let array = [];
      let j = 0;
      for (let i = start; i <= end; i++) {
        array[j] = i;
        j++
      }

      return array;
    }
  }
};
</script>