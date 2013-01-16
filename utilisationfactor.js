
// Calculation of mean internal temperature for heating
// Calculation of mean internal temperature is based on the heating patterns defined in Table 9.

function calc_utilisation_factor(TMP,HLP,H,Ti,Te,G)
{
  /* 
    Symbols and units
    H = heat transfer coefficient, (39)m (W/K)
    G = total gains, (84)m (W)
    Ti = internal temperature (°C)
    Te = external temperature, (96)m (°C)
    TMP = Thermal Mass Parameter, (35), (kJ/m2K) (= Cm for building / total floor area)
    HLP = Heat Loss Parameter, (40)m (W/m2K)
    τ = time constant (h)
    η = utilisation factor
    L = heat loss rate (W)
  */

  // Calculation of utilisation factor
  var tau = TMP / (3.6 * HLP);
  var a = 1 + tau / 15;
  var L = H * (Ti - Te);
  var y = G / L;

  // Note: to avoid instability when γ is close to 1 round γ to 8 decimal places
  y = y.toFixed(8);

  var n = 0;
  if (y>0 && y!=1) n = (1 - Math.pow(y,a)) / (1 - Math.pow(y,a+1));
  if (y == 1) n = a / (a + 1);

  return n;
}
