function calculate(data) { 

// Table 1a: Number of days in month, nm
data['table1a'] = [31,28,31,30,31,30,31,31,30,31,30,31];

// Table 1c: Monthly factors for hot water use
data['table1c'] = [1.1,1.06,1.02,0.98,0.94,0.90,0.90,0.94,0.98,1.02,1.06,1.10];

// Table 1d: Temperature rise of hot water drawn off (∆Tm, in K)
data['table1d'] = [41.2,41.4,40.1,37.6,36.4,33.9,30.4,33.4,33.5,36.3,39.4,39.9];

var table_u1 = [
[4.5,5.0,6.8,8.7,11.7,14.6,16.9,16.9,14.3,10.8,7.0,4.9],
[5.1,5.5,7.4,9.3,12.6,15.4,17.8,17.8,15.1,11.6,7.6,5.5],
[5.3,5.4,7.4,9.2,12.6,15.2,17.6,17.8,15.2,11.9,7.9,5.8],
[5.5,5.7,7.5,9.2,12.6,15.2,17.4,17.6,15.1,11.8,8.1,5.9],
[6.4,6.5,7.9,9.3,12.4,14.7,16.8,17.0,14.9,12.0,8.9,7.0],
[5.4,5.7,7.5,9.2,12.6,15.2,17.4,17.3,14.9,11.5,8.0,5.9],
[4.9,5.3,7.1,9.0,12.2,14.9,17.2,17.1,14.5,11.0,7.3,5.2],
[5.1,5.5,7.0,8.9,12.0,14.5,16.6,16.5,14.1,10.9,7.6,5.4],
[4.6,4.9,6.2,8.1,11.1,13.5,15.5,15.4,13.1,10.1,7.0,4.9],
[4.3,4.7,6.1,7.9,10.7,13.4,15.5,15.4,13.0,9.8,6.6,4.6],
[4.5,4.9,6.4,8.2,11.2,14.0,16.2,16.1,13.6,10.3,6.9,4.8],
[4.5,5.0,6.8,8.7,11.7,14.6,16.9,16.9,14.3,10.8,7.0,4.9],
[4.6,5.0,7.0,9.0,12.2,15.0,17.5,17.6,15.0,11.4,7.3,5.1],
[5.7,5.8,7.3,8.9,12.0,14.3,16.4,16.3,14.2,11.2,8.2,6.2],
[4.8,4.9,6.0,7.9,10.8,13.1,14.9,14.8,12.8,9.8,7.0,5.1],
[4.1,4.4,5.7,7.7,10.6,13.2,15.2,15.0,12.7,9.4,6.3,4.3],
[4.0,4.2,5.5,7.4,10.1,12.8,14.9,14.7,12.5,9.2,6.2,4.1],
[4.4,4.3,5.5,7.4,10.2,12.5,14.5,14.4,12.3,9.2,6.5,4.5],
[5.3,5.0,5.9,7.4,9.8,11.7,13.7,13.7,12.1,9.5,7.2,5.6],
[4.9,4.5,5.2,6.9,9.1,11.2,13.3,13.6,11.9,9.3,6.9,5.2],
[4.7,4.1,4.7,6.4,8.5,10.6,12.7,13.0,11.4,8.8,6.5,4.9],
[5.2,5.4,6.8,8.3,11.1,13.4,15.4,15.2,13.2,10.2,7.4,5.5]];

data['3a'] = data['1a'] * data['2a'];
data['3b'] = data['1b'] * data['2b'];
data['3c'] = data['1c'] * data['2c'];
data['3d'] = data['1d'] * data['2d'];
data['3e'] = data['1e'] * data['2e'];
data['3f'] = data['1f'] * data['2f'];
data['3g'] = data['1g'] * data['2g'];
data['3h'] = data['1h'] * data['2h'];
data['4'] = data['1a'] + data['1b'] + data['1c'] + data['1d'] + data['1e'] + data['1f'] + data['1g'] + data['1h'];
data['5'] = data['3a'] + data['3b'] + data['3c'] + data['3d'] + data['3e'] + data['3f'] + data['3g'] + data['3h'];
data['6ad'] = data['6aa'] + data['6ab'] + data['6ac'];
data['6a'] = data['6ad'] * 40;
data['6bd'] = data['6ba'] + data['6bb'] + data['6bc'];
data['6b'] = data['6bd'] * 20;
data['7a'] = data['7aa'] * 10;
data['7b'] = data['7ba'] * 10;
data['7c'] = data['7ca'] * 40;
data['8a'] = data['6a'] + data['6b'] + data['7a'] + data['7b'] + data['7c'];
data['8'] = data['8a'] / data['5'];
data['10'] = (data['9'] - 1) * 0.1;
data['15'] = -0.2 * data['14'] / 100 + 0.25;
data['16'] = data['8'] + data['10'] + data['11'] + data['12'] + data['13'] + data['15'];
data['18'] = data['16'] * 1;
data['20'] = -0.075 * data['19'] + 1;
data['21'] = data['18'] * data['20'];
for (var i=1; i<13; i++) { data['22a-'+i] = data['22-'+i] / 4; }
for (var i=1; i<13; i++) { data['22b-'+i] = data['22a-'+i] * data['21']; }
for (var i=1; i<13; i++) { data['24a-'+i] = data['23c'] / -100 + 1 * data['23b'] + data['22b-'+i]; }
for (var i=1; i<13; i++) { data['24b-'+i] = data['22b-'+i] + data['23b']; }

for (var i=1; i<13; i++) 
{ 
  if (data['24b-'+i] < (0.5*data['23b'])) 
    data['24c-'+i] = data['23b']; 
  else 
    data['24c-'+i] = data['22b-'+i] + 0.5*data['23b'];
}

for (var i=1; i<13; i++) 
{ 
  if (data['22b-'+i] >= 1) 
    data['24d-'+i] = data['22b-'+i]; 
  else 
    data['24d-'+i] = 0.5 + (data['22b-'+i]*data['22b-'+i]*0.5);
}

/*
data['26'] = data['26-1'] * data['26-2'];
data['27'] = data['27-1'] * data['27-2'];
data['27a'] = data['27a-1'] * data['27a-2'];

data['28'] = data['28-1'] * data['28-2'];
data['28-4'] = data['28-1'] * data['28-3'];

data['28a'] = data['28a-1'] * data['28a-2'];
data['28a-4'] = data['28a-1'] * data['28a-3'];

data['28b'] = data['28b-1'] * data['28b-2'];
data['28b-4'] = data['28b-1'] * data['28b-3'];

data['29-3'] = data['29-1'] - data['29-2'];
data['29'] = data['29-3'] * data['29-4'];
data['29-6'] = data['29-3'] * data['29-5'];

data['29a-3'] = data['29a-1'] - data['29a-2'];
data['29a'] = data['29a-3'] * data['29a-4'];
data['29a-6'] = data['29a-3'] * data['29a-5'];

data['30-3'] = data['30-1'] - data['30-2'];
data['30'] = data['30-3'] * data['30-4'];
data['30-6'] = data['30-3'] * data['30-5'];

// Total area of external elements 
data['31'] = data['26-1'] + data['27-1'] + data['27a-1'] + data['28-1'] + data['28a-1'] + data['28b-1'] + data['29-3'] + data['29a-3'] + data['30-3'];*/

data['32'] = data['32-1'] * data['32-2'];	// Party wall - loss calc
data['32-4'] = data['32-3'] * data['32-1'];	// Party wall - therm mass calc
data['32a-3'] = data['32a-2'] * data['32a-1'];	// Party floor
data['32b-3'] = data['32b-2'] * data['32b-1'];	// Party ceiling
data['32c-3'] = data['32c-2'] * data['32c-1'];  // Internal wall **
data['32d-3'] = data['32d-2'] * data['32d-1'];	// Internal floor
data['32e-3'] = data['32e-2'] * data['32e-1'];	// Internal ceiling

// Fabric heat loss
// data['33'] = data['26'] + data['27'] + data['27a'] + data['28'] + data['28a'] + data['28b'] + data['29'] + data['29a'] + data['30'] + data['32'];

data['33'] = data['externalheatloss'] + data['32'];

// Heat capacity
data['34'] = data['itemsheatcapacity'] + data['32-4'] + data['32a-3'] + data['32b-3'] + data['32c-3'] + data['32d-3'] + data['32e-3'];

// Thermal mass parameter
data['35'] = data['34'] / data['4'];

data['37'] = data['33'] + data['36'];
for (var i=1; i<13; i++) { data['38-'+i] = 0.33 * data['25-'+i] * data['5']; }
for (var i=1; i<13; i++) { data['39-'+i] = data['37'] + data['38-'+i]; }

// Average (39)
data['39'] = 0;
for (var i=1; i<13; i++) { data['39'] += data['39-'+i]; }
data['39'] = data['39'] / 12;

for (var i=1; i<13; i++) { data['40-'+i] = data['39-'+i] / data['4']; }

// Average (40)
data['40'] = 0;
for (var i=1; i<13; i++) { data['40'] += data['40-'+i]; }
data['40'] = data['40'] / 12;


// Copy days in month from table 1a
for (var i=1; i<13; i++) { data['41-'+i] = data['table1a'][i-1]; }

/*

  4. Water heating energy requirement

*/


// Annual average hot water usage in litres per day
data['43'] = (data['42']*25) + 36;

// Hot water usage in litres per day for each month V d,m = factor from Table 1c × (43)
for (var i=1; i<13; i++) { data['44-'+i] = data['table1c'][i-1] * data['43']; }

// Total (44)
data['44'] = 0; for (var i=1; i<13; i++) { data['44'] += data['44-'+i]; }

// Energy content of hot water used - calculated monthly = 4.190 × Vd,m × nm × ∆Tm / 3600 kWh/month (see Tables 1b, 1c, 1d)
for (var i=1; i<13; i++) { data['45-'+i] = 4.190 * data['44-'+i] * data['41-'+i] * data['table1d'][i-1] / 3600; }

// Total (45)
data['45'] = 0; for (var i=1; i<13; i++) { data['45'] += data['45-'+i]; }

// Distribution loss (46)m = 0.15 x (45)m
for (var i=1; i<13; i++) { data['46-'+i] = 0.15 * data['45-'+i]; }

// Energy lost from water storage, kWh/day
data['49'] = data['47'] + data['48'];

// Energy lost from water storage, kWh/day (54) = (50) × (51) × (52) × (53) 
data['54'] = data['50'] * data['51'] * data['52'] * data['53'];

// Water storage loss calculated for each month (56)m = (55) × (41)m
for (var i=1; i<13; i++) { data['56-'+i] = data['55'] * data['41-'+i]; }

// If cylinder contains dedicated solar storage, (57)m = (56)m × [(50) – (H11)] ÷ (50), else (57)m = (56)m where (H11) is from Appendix H
for (var i=1; i<13; i++) { 

 if (data['50']>0) data['57-'+i] = data['56-'+i] * (data['50'] - data['H11']) / data['50']; else data['57-'+i] = 0;

}

// Good to review this calculation:
// Primary loss on a daily basis
var summer = 14 * ( (0.0091 * data['58a'] + 0.0245 * (1 - data['58a'])) * data['58b'] + 0.0263 );
var winter = 14 * ( (0.0091 * data['58a'] + 0.0245 * (1 - data['58a'])) * data['58c'] + 0.0263 );

//Use summer value for June, July, August and September and winter value for other months.
/*data['59-1'] = data['table1a'][0] * winter;
data['59-2'] = data['table1a'][1] * winter;
data['59-3'] = data['table1a'][2] * winter;
data['59-4'] = data['table1a'][3] * winter;
data['59-5'] = data['table1a'][4] * winter;

data['59-6'] = data['table1a'][5] * summer;
data['59-7'] = data['table1a'][6] * summer;
data['59-8'] = data['table1a'][7] * summer;
data['59-9'] = data['table1a'][8] * summer;

data['59-10'] = data['table1a'][9] * winter;
data['59-11'] = data['table1a'][10] * winter;
data['59-12'] = data['table1a'][11] * winter;*/

for (var i=1; i<13; i++) { data['59-'+i] = (data['58'] / 365.0) * data['41-'+i]; }

// Total (58)
//data['58'] = 0; for (var i=1; i<13; i++) { data['58'] += data['59-'+i]; }
// for (var i=1; i<13; i++) { data['59-'+i] = data['58'] / 365 * data['41-'+i]; }

data['59'] = data['59o1'] + data['59o2'] + data['59o3'] + data['59o4'] + data['59o5'] + data['59o6'] + data['59o7'] + data['59o8'] + data['59o9'] + data['59o10'] + data['59o11'] + data['59o12'];
data['61'] = data['61o1'] + data['61o2'] + data['61o3'] + data['61o4'] + data['61o5'] + data['61o6'] + data['61o7'] + data['61o8'] + data['61o9'] + data['61o10'] + data['61o11'] + data['61o12'];


for (var i=1; i<13; i++) { data['62-'+i] = 0.85 * data['45-'+i] + data['46-'+i] + data['57-'+i] + data['59-'+i] + data['61-'+i];}

data['62'] = data['62o1'] + data['62o2'] + data['62o3'] + data['62o4'] + data['62o5'] + data['62o6'] + data['62o7'] + data['62o8'] + data['62o9'] + data['62o10'] + data['62o11'] + data['62o12'];
data['63'] = data['63o1'] + data['63o2'] + data['63o3'] + data['63o4'] + data['63o5'] + data['63o6'] + data['63o7'] + data['63o8'] + data['63o9'] + data['63o10'] + data['63o11'] + data['63o12'];
for (var i=1; i<13; i++) { data['64-'+i] = data['62-'+i] + data['63-'+i]; }

// Total (64)
data['64'] = 0; for (var i=1; i<13; i++) { data['64'] += data['64-'+i]; }
if (data['64']<0) data['64'] = 0;

// Heat gains from water heating, kWh/month 0.25 × [0.85 × (45)m + (61)m] + 0.8 × [(46)m + (57)m + (59)m ]
for (var i=1; i<13; i++) {
  data['65-'+i] = 0.25 * (0.85 * data['45-'+i] + data['61-'+i]) + 0.8 * (data['46-'+i] + data['57-'+i] + data['59-'+i] );
}

/*

  Internal gains

*/

// Metabolic
for (var i=1; i<13; i++) {
  data['66-'+i] = 60 * data['42'];
}

// Cooking
for (var i=1; i<13; i++) {
  data['69-'+i] = 35 + 7 * data['42'];
}

// Losses
for (var i=1; i<13; i++) {
  data['71-'+i] = -40 * data['42'];
}

// Water heating gains
for (var i=1; i<13; i++) {
  data['72-'+i] = 1000 * data['65-'+i] / (data['41-'+i] * 24);
}

// SUM of all gains
for (var i=1; i<13; i++) { data['73-'+i] = data['66-'+i] + data['67-'+i] + data['68-'+i] + data['69-'+i] + data['70-'+i] + data['71-'+i] + data['72-'+i]; }


/*

SOLAR GAINS

// Calculate solar flux for January
data['74c'] = solar_rad(data['H5a'],0,90,0);
data['75c'] = solar_rad(data['H5a'],1,90,0);
data['76c'] = solar_rad(data['H5a'],2,90,0);
data['77c'] = solar_rad(data['H5a'],3,90,0);
data['78c'] = solar_rad(data['H5a'],4,90,0);
data['79c'] = solar_rad(data['H5a'],3,90,0);
data['80c'] = solar_rad(data['H5a'],2,90,0);
data['81c'] = solar_rad(data['H5a'],1,90,0);
data['82c'] = solar_rad(data['H5a'],4,0,0);

// Gains (W)
for (var i=74; i<83; i++) { 
  data[i+''] = data[i+'a'] * data[i+'b'] * data[i+'c'] * 0.9 * data[i+'d'] * data[i+'e'];
}

for (var i=1; i<13; i++) { data['83-'+i] = data['74-'+i] + data['75-'+i] + data['76-'+i] + data['77-'+i] + data['78-'+i] + data['79-'+i] + data['80-'+i] + data['81-'+i] + data['82-'+i]; }

*/

// Monthly average external temperature from Table U1
var region = data['H5a'];
if (region ==0) region =1;
for (var i=1; i<13; i++) data['96-'+i] = table_u1[region][i-1];

// Total gains – internal and solar (84)m = (73)m + (83)m , watts
for (var i=1; i<13; i++) { data['84-'+i] = data['73-'+i] + data['83-'+i]; }

for (var i=1; i<13; i++) 
{ 
  data['86-'+i] = calc_utilisation_factor(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i]);
}


/*

Table 9c: Heating requirement

Living area

1. Set Ti to the temperature for the living area during heating periods (Table 9)

2. Calculate the utilisation factor (Table 9a)

3 Calculate the temperature reduction (Table 9b) for each off period (Table 9), u1 and u2, for weekdays
*/

for (var i=1; i<13; i++) 
{ 
  var Th = data['85']; // 21C;
  var R = 1.0; 

  var u1a = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,7);

  var u1b = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,0);

  var u2 = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,8);

  var Tweekday = Th - (u1a + u2);
  var Tweekend = Th - (u1b + u2);
  data['87-'+i] = (5*Tweekday + 2*Tweekend) / 7;
}

// rest of dwelling

for (var i=1; i<13; i++) 
{ 
  var Th = 21;
  var R = 1.0; 

  var u1a = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,7);

  var u1b = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,0);

  var u2 = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,8);

  var Tweekday = Th - (u1a + u2);
  var Tweekend = Th - (u1b + u2);
  data['88-'+i] = (5*Tweekday + 2*Tweekend) / 7;
}

for (var i=1; i<13; i++) 
{ 
  var Th = 21 - 0.5 * data['40-'+i];
  var R = 1.0; 

  var u1a = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,7);

  var u1b = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,0);

  var u2 = calc_temperature_reduction(data['35'],data['40-'+i],data['39-'+i],data['85'],data['96-'+i],data['84-'+i],R,Th,8);

  var Tweekday = Th - (u1a + u2);
  var Tweekend = Th - (u1b + u2);
  data['90-'+i] = (5*Tweekday + 2*Tweekend) / 7;
}

for (var i=1; i<13; i++) 
{ 
  var Ti = 21 - 0.5 * data['40-'+i];
  var HLP = data['40-'+i];
  if (HLP>6.0) HLP = 6.0;
  data['89-'+i] = calc_utilisation_factor(data['35'],HLP,data['39-'+i],Ti,data['96-'+i],data['84-'+i]);
}

data['91'] = data['4b'] / data['4'];

for (var i=1; i<13; i++) 
{ 
  data['92-'+i] = (data['91'] * data['87-'+i]) + (1 - data['91']) * data['90-'+i];
}

/*
  8. Space heating requirement
*/

for (var i=1; i<13; i++) 
{ 
  data['94-'+i] = calc_utilisation_factor(data['35'],data['40-'+i],data['39-'+i],data['92-'+i],data['96-'+i],data['84-'+i]);
}

for (var i=1; i<13; i++) { data['95-'+i] = data['94-'+i] * data['84-'+i]; }

for (var i=1; i<13; i++) { data['97-'+i] = data['39-'+i] * (data['92-'+i] - data['96-'+i]); }

for (var i=1; i<13; i++) { data['98-'+i] = data['97-'+i] - data['95-'+i] * 0.024 * data['41-'+i] * data['97a-'+i]; }

data['98'] = 0; for (var i=1; i<13; i++) { data['98'] += data['98-'+i]; }

data['99'] = data['98'] / data['4'];
/*
data['98'] = data['98o1'] + data['98o2'] + data['98o3'] + data['98o4'] + data['98o5'] + data['98o6'] + data['98o7'] + data['98o8'] + data['98o9'] + data['98o10'] + data['98o11'] + data['98o12'];
data['99'] = data['98'] / data['4'];
for (var i=1; i<13; i++) { data['102-'+i] = data['100-'+i] * data['101-'+i]; }
data['104'] = data['104o1'] + data['104o2'] + data['104o3'] + data['104o4'] + data['104o5'] + data['104o6'] + data['104o7'] + data['104o8'] + data['104o9'] + data['104o10'] + data['104o11'] + data['104o12'];
data['106'] = data['106o1'] + data['106o2'] + data['106o3'] + data['106o4'] + data['106o5'] + data['106o6'] + data['106o7'] + data['106o8'] + data['106o9'] + data['106o10'] + data['106o11'] + data['106o12'];
for (var i=1; i<13; i++) { data['107-'+i] = data['104-'+i] * data['105'] * data['106-'+i]; }
data['107'] = data['107o1'] + data['107o2'] + data['107o3'] + data['107o4'] + data['107o5'] + data['107o6'] + data['107o7'] + data['107o8'] + data['107o9'] + data['107o10'] + data['107o11'] + data['107o12'];
data['108'] = data['107'] / data['4'];
data['109'] = data['99'] + data['108'];
data['202'] = data['201'] - 1;
data['204'] = data['203'] - 1 * data['202'];
data['205'] = data['202'] * data['203'];
for (var i=1; i<13; i++) { data['211-'+i] = data['98-'+i] * data['204'] * 100 / data['206']; }
data['211'] = data['211o1'] + data['211o2'] + data['211o3'] + data['211o4'] + data['211o5'] + data['211o6'] + data['211o7'] + data['211o8'] + data['211o9'] + data['211o10'] + data['211o11'] + data['211o12'];
for (var i=1; i<13; i++) { data['213-'+i] = data['98-'+i] * data['205'] * 100 / data['207']; }
data['213'] = data['213o1'] + data['213o2'] + data['213o3'] + data['213o4'] + data['213o5'] + data['213o6'] + data['213o7'] + data['213o8'] + data['213o9'] + data['213o10'] + data['213o11'] + data['213o12'];
for (var i=1; i<13; i++) { data['215-'+i] = data['98-'+i] * data['201'] * 100 / data['208']; }
data['215'] = data['215o1'] + data['215o2'] + data['215o3'] + data['215o4'] + data['215o5'] + data['215o6'] + data['215o7'] + data['215o8'] + data['215o9'] + data['215o10'] + data['215o11'] + data['215o12'];
data['217'] = data['64o1'] + data['64o2'] + data['64o3'] + data['64o4'] + data['64o5'] + data['64o6'] + data['64o7'] + data['64o8'] + data['64o9'] + data['64o10'] + data['64o11'] + data['64o12'];
data['217'] = data['217o1'] + data['217o2'] + data['217o3'] + data['217o4'] + data['217o5'] + data['217o6'] + data['217o7'] + data['217o8'] + data['217o9'] + data['217o10'] + data['217o11'] + data['217o12'];
for (var i=1; i<13; i++) { data['219-'+i] = data['64-'+i] * 100 / data['217-'+i]; }
data['219'] = data['219o1'] + data['219o2'] + data['219o3'] + data['219o4'] + data['219o5'] + data['219o6'] + data['219o7'] + data['219o8'] + data['219o9'] + data['219o10'] + data['219o11'] + data['219o12'];
for (var i=1; i<13; i++) { data['221-'+i] = data['107-'+i] * 100 / data['209']; }
data['221'] = data['221o1'] + data['221o2'] + data['221o3'] + data['221o4'] + data['221o5'] + data['221o6'] + data['221o7'] + data['221o8'] + data['221o9'] + data['221o10'] + data['221o11'] + data['221o12'];
data['231'] = data['230a'] + data['230b'] + data['230c'] + data['230d'] + data['230e'] + data['230f'] + data['230g'];
data['255'] = data['240'] + data['241'] + data['242'] + data['243'] + data['244'] + data['245'] + data['246'] + data['247'] + data['248'] + data['249'] + data['250'] + data['251'];
*/
data['H4'] = data['H3b'] / data['H2'];

// test: region wales (index:13), orient south (index: 4), inclination 35 degrees
data['H5'] = annual_solar_rad(data['H5a'],data['H5b'],data['H5c']);

data['H7'] = data['H1'] * data['H2'] * data['H5'] * data['H6'];

data['H8'] = data['H7'] / data['45'];

if (data['H8']>0) data['H9'] = 1 - Math.exp(-1/data['H8']); else data['H9'] = 0;

if (data['H4'] < 20) 
  data['H10'] = 0.97 - 0.0367 * data['H4'] + 0.0006 * data['H4'] * data['H4'];
else 
  data['H10'] = 0.693 - 0.0108 * data['H4'];

// Effective solar volume, Veff
data['H13'] = data['H11'] + 0.3 * (data['H12'] - data['H11']);

// Daily hot water demand, Vd,average, (litres)
data['H14'] = data['43'];

// Volume ratio Veff/Vd,average (H13) ÷ (H14)
data['H15'] = data['H13'] / data['H14'];

// Solar storage volume factor
data['H16'] = 1 + 0.2 * Math.log(data['H15']);
if (data['H16']>1) data['H16'] = 1;

//Annual solar input Qs (kWh)
data['H17'] = data['H7'] * data['H9'] * data['H10']* data['H16'];

/*

Lighting 

*/

data['L1'] = 59.73 * Math.pow((data['4'] * data['42']),0.4714);

data['L2'] = 1 - (0.50 * data['LLE'] / data['L']);

var windows = data['window'];

var sum = 0;
for (z in windows) 
{
  var overshading = windows[z].overshading;
  var accessfactor = [0.5,0.67,0.83,1.0];
  sum += 0.9 * windows[z].area * windows[z].g * windows[z].ff * accessfactor[overshading];
}

data['L5'] = sum / data['4'];

if (data['L5']<=0.095) {
  data['L3'] = 52.2 * Math.pow(data['L5'],2) - 9.94 * data['L5'] + 1.433;
} else {
  data['L3'] = 0.96;
}

data['L6'] = data['L1'] * data['L2'] * data['L3'];

for (var i=1; i<13; i++) { data['L7-'+i] = data['L6'] * (1.0 + (0.5 * Math.cos((2*Math.PI * (i - 0.2)) / 12.0))) * data['41-'+i] / 365.0;}

data['L8'] = 0; for (var i=1; i<13; i++) data['L8'] += data['L7-'+i];

for (var i=1; i<13; i++) { data['L9-'+i] = data['L7-'+i] * 0.85 * 1000 / (24 * data['41-'+i]); }
for (var i=1; i<13; i++) { data['L9a-'+i] = 0.4 * data['L9-'+i]; }
for (var i=1; i<13; i++) { data['67-'+i] = data['L9-'+i]; }

/*

Electrical appliances

*/

data['L10'] = 207.8 * Math.pow((data['4'] * data['42']),0.4714);

for (var i=1; i<13; i++) { data['L11-'+i] = data['L10'] * (1.0 + (0.157 * Math.cos((2*Math.PI * (i - 1.78)) / 12.0))) * data['41-'+i] / 365.0;}

data['L12'] = 0; for (var i=1; i<13; i++) data['L12'] += data['L11-'+i];

for (var i=1; i<13; i++) { data['L13-'+i] = data['L11-'+i] * 1000 / (24 * data['41-'+i]); }
for (var i=1; i<13; i++) { data['L13a-'+i] = 0.67 * data['L13-'+i]; }
for (var i=1; i<13; i++) { data['68-'+i] = data['L13-'+i]; }

data['L14'] =  (data['L12'] * 0.522 ) / data['4'];

/*

Cooking

*/

data['L15'] = 35 + 7 * data['42']; 

data['L15a'] = 23 + 5 * data['42']; 

data['L16'] = (119 + 24 * data['42']) / data['4'];

return data; 
}

