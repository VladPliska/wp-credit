'use strict';

function Calculate() {
    const wpfcInc = '+';
    const wpfcExc = '-';
    const PPPRate = 1.15;

    if (parseInt(document.Finance.NetAmount.value, 10) < parseInt(document.Finance.Deposit.value, 10)) {
        // Validate Deposit field
    } else {
        let BalloonValue = parseFloat(document.Finance.NetAmount.value) * parseFloat(document.Finance.PcentBalloon.value / 100);
        let AmtFinanced = parseFloat(document.Finance.NetAmount.value) - parseFloat(BalloonValue) - parseFloat(document.Finance.Deposit.value) - parseFloat(document.Finance.TradeIn.value);
        let NetCost = parseFloat(document.Finance.NetAmount.value) - parseFloat(document.Finance.Deposit.value) - parseFloat(document.Finance.TradeIn.value);

        let MonthlyRate = 0;
        let SubTotal1 = 0;

        if (parseInt(document.Finance.Rate.value, 10) > 0) {
            MonthlyRate = Math.pow((1 + (document.Finance.Rate.value / 100)), (1 / 12)) - 1;
            SubTotal1 = (1 / MonthlyRate);
		}

        let Periods = 0;

        const periodObject = {
            1: 12,
            2: 24,
            3: 36,
            4: 48,
            5: 60,
            6: 72
        };

        if (parseInt(document.Finance.Rate.value) === 0) {
            if (document.Finance.PPP.checked === true) {
                document.Finance.Include.value = wpfcInc;
            } else {
                document.Finance.Include.value = wpfcExc;
            }
        }

        for (const [key, value] of Object.entries(periodObject)) {
            Periods = value;

            if (document.Finance.Rate.value == 0) {
                if (document.Finance.PPP.checked == true) {
                    document.Finance['monthpay' + key].value = Math.round(((AmtFinanced / Periods) * 100) / 100) * PPPRate;
                } else {
                    document.Finance['monthpay' + key].value = Math.round((AmtFinanced / Periods) * 100) / 100;
                }
                document.Finance['finalpay' + key].value = Math.round((BalloonValue) * 100) / 100;
                document.Finance['total' + key].value = AmtFinanced;
                document.Finance['credit' + key].value = 0;
            } else {
                var SubTotal2 = (1 / (MonthlyRate * (Math.pow(1 + MonthlyRate, Periods))));
                var MonthlyFinanceCost1 = (AmtFinanced / (SubTotal1 - SubTotal2));
                var MonthlyFinanceCost2 = (BalloonValue * MonthlyRate);
                if (document.Finance.PPP.checked == true) {
                    document.Finance.Include.value = wpfcInc;
                    document.Finance['monthpay' + key].value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * 100) * PPPRate)) / 100;
                } else {
                    document.Finance.Include.value = wpfcExc;
                    document.Finance['monthpay' + key].value = Math.round(((MonthlyFinanceCost1 + MonthlyFinanceCost2)) * 100) / 100;
                }
                document.Finance['finalpay' + key].value = Math.round((BalloonValue) * 100) / 100;
                document.Finance['total' + key].value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * Periods) + BalloonValue) * 100) / 100;
                document.Finance['credit' + key].value = Math.round((document.Finance['total' + key].value - NetCost) * 100) / 100;
            }
        }

        //

        /*
		Periods = 12;
		if (document.Finance.Rate.value == 0) {
			if (document.Finance.PPP.checked == true) {
				document.Finance.Include.value = wpfcInc;
				document.Finance.monthpay1.value = Math.round(((AmtFinanced / Periods) * 100) / 100) * PPPRate;
			} else {
				document.Finance.Include.value = wpfcExc;
				document.Finance.monthpay1.value = Math.round((AmtFinanced / Periods) * 100) / 100;
			}
			document.Finance.finalpay1.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total1.value = AmtFinanced;
			document.Finance.credit1.value = 0;
		} else {
			var SubTotal2 = (1 / (MonthlyRate * (Math.pow(1 + MonthlyRate, Periods))));
			var MonthlyFinanceCost1 = (AmtFinanced / (SubTotal1 - SubTotal2));
			var MonthlyFinanceCost2 = (BalloonValue * MonthlyRate);
			if (document.Finance.PPP.checked == true) {
				document.Finance.Include.value = wpfcInc;
				document.Finance.monthpay1.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * 100) * PPPRate)) / 100;
			} else {
				document.Finance.Include.value = wpfcExc;
				document.Finance.monthpay1.value = Math.round(((MonthlyFinanceCost1 + MonthlyFinanceCost2)) * 100) / 100;
			}
			document.Finance.finalpay1.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total1.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * Periods) + BalloonValue) * 100) / 100;
			document.Finance.credit1.value = Math.round((document.Finance.total1.value - NetCost) * 100) / 100;
		}

		Periods = 24;
		if (document.Finance.Rate.value == 0) {
			if (document.Finance.PPP.checked == true) {
				document.Finance.monthpay2.value = Math.round(((AmtFinanced / Periods) * 100) / 100) * PPPRate;
			} else {
				document.Finance.monthpay2.value = Math.round((AmtFinanced / Periods) * 100) / 100;
			}
			document.Finance.finalpay2.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total2.value = AmtFinanced;
			document.Finance.credit2.value = 0;
		} else {
			SubTotal2 = (1 / (MonthlyRate * (Math.pow(1 + MonthlyRate, Periods))));
			MonthlyFinanceCost1 = (AmtFinanced / (SubTotal1 - SubTotal2));
			MonthlyFinanceCost2 = (BalloonValue * MonthlyRate);
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay2.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * 100) * PPPRate)) / 100;
			else
				document.Finance.monthpay2.value = Math.round(((MonthlyFinanceCost1 + MonthlyFinanceCost2)) * 100) / 100;
			document.Finance.finalpay2.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total2.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * Periods) + BalloonValue) * 100) / 100;
			document.Finance.credit2.value = Math.round((document.Finance.total2.value - NetCost) * 100) / 100;
		}

		Periods = 36;
		if(document.Finance.Rate.value == 0) {
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay3.value = Math.round(((AmtFinanced/Periods) * 100) / 100) * PPPRate;
			else
				document.Finance.monthpay3.value = Math.round((AmtFinanced/Periods) * 100) / 100;
			document.Finance.finalpay3.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total3.value = AmtFinanced;
			document.Finance.credit3.value = 0;
		} else {
			SubTotal2 = (1 / (MonthlyRate * (Math.pow(1 + MonthlyRate, Periods))));
			MonthlyFinanceCost1 = (AmtFinanced / (SubTotal1 - SubTotal2));
			MonthlyFinanceCost2 = (BalloonValue * MonthlyRate);
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay3.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * 100) * PPPRate)) / 100;
			else
				document.Finance.monthpay3.value = Math.round(((MonthlyFinanceCost1 + MonthlyFinanceCost2)) * 100) / 100;
			document.Finance.finalpay3.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total3.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * Periods) + BalloonValue) * 100) / 100;
			document.Finance.credit3.value = Math.round((document.Finance.total3.value - NetCost) * 100) / 100;
		}

		Periods = 48;
		if(document.Finance.Rate.value == 0) {
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay4.value = Math.round(((AmtFinanced / Periods) * 100) / 100) * PPPRate;
			else
				document.Finance.monthpay4.value = Math.round((AmtFinanced / Periods) * 100) / 100;
			document.Finance.finalpay4.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total4.value = AmtFinanced;
			document.Finance.credit4.value = 0;
		} else {
			SubTotal2 = (1 / (MonthlyRate * (Math.pow(1 + MonthlyRate, Periods))));
			MonthlyFinanceCost1 = (AmtFinanced / (SubTotal1 - SubTotal2));
			MonthlyFinanceCost2 = (BalloonValue * MonthlyRate);
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay4.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * 100) * PPPRate)) / 100;
			else
				document.Finance.monthpay4.value = Math.round(((MonthlyFinanceCost1 + MonthlyFinanceCost2)) * 100) / 100;
			document.Finance.finalpay4.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total4.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * Periods) + BalloonValue) * 100) / 100;
			document.Finance.credit4.value = Math.round((document.Finance.total4.value - NetCost) * 100) / 100;
		}

		Periods = 60;
		if (document.Finance.Rate.value == 0) {
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay5.value = Math.round(((AmtFinanced/Periods) * 100) / 100) * PPPRate;
			else
				document.Finance.monthpay5.value = Math.round((AmtFinanced/Periods) * 100) / 100;
			document.Finance.finalpay5.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total5.value = AmtFinanced;
			document.Finance.credit5.value = 0;
		} else {
			SubTotal2 = (1 / (MonthlyRate * (Math.pow(1 + MonthlyRate, Periods))));
			MonthlyFinanceCost1 = (AmtFinanced / (SubTotal1 - SubTotal2));
			MonthlyFinanceCost2 = (BalloonValue * MonthlyRate);
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay5.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * 100) * PPPRate)) / 100;
			else
				document.Finance.monthpay5.value = Math.round(((MonthlyFinanceCost1 + MonthlyFinanceCost2)) * 100) / 100;
			document.Finance.finalpay5.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total5.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * Periods) + BalloonValue) * 100) / 100;
			document.Finance.credit5.value = Math.round((document.Finance.total5.value - NetCost) * 100) / 100;
		}

		Periods = 72;
		if (document.Finance.Rate.value == 0) {
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay6.value = Math.round(((AmtFinanced/Periods) * 100) / 100) * PPPRate;
			else
				document.Finance.monthpay6.value = Math.round((AmtFinanced/Periods) * 100) / 100;
			document.Finance.finalpay6.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total6.value = AmtFinanced;
			document.Finance.credit6.value = 0;
		} else {
			SubTotal2 = (1 / (MonthlyRate * (Math.pow(1 + MonthlyRate, Periods))));
			MonthlyFinanceCost1 = (AmtFinanced / (SubTotal1 - SubTotal2));
			MonthlyFinanceCost2 = (BalloonValue * MonthlyRate);
			if(document.Finance.PPP.checked == true)
				document.Finance.monthpay6.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * 100) * PPPRate)) / 100;
			else
				document.Finance.monthpay6.value = Math.round(((MonthlyFinanceCost1 + MonthlyFinanceCost2)) * 100) / 100;
			document.Finance.finalpay6.value = Math.round((BalloonValue) * 100) / 100;
			document.Finance.total6.value = Math.round((((MonthlyFinanceCost1 + MonthlyFinanceCost2) * Periods) + BalloonValue) * 100) / 100;
			document.Finance.credit6.value = Math.round((document.Finance.total6.value - NetCost) * 100) / 100;
		}
        /**/
	}

	for (var c = 0; c < document.Finance.finance_Months.length; c++) {
		if (document.Finance.finance_Months[c].checked) {
			var ppayment = parseFloat(document.Finance['monthpay' + (c + 1)].value * document.Finance.finance_Months[c].value);
			break;
		}
	}

	document.getElementById('total_cost').value = Math.round(ppayment * 100) / 100;
}

function submitform(frm) {
	frm.submit();
}

function calcAmt(frm) {
	// get selected loan type value from the dropdown
	var x,
		y,
		z,
		e = document.getElementById('slt_type');
	var slt_value = e.options[e.selectedIndex].value;

	var princ = frm.txtAmt.value; // principal
	var i_mn = slt_value; // interest
	var i_fn = slt_value;
	var i_wk = slt_value;
	var paymts_mn = frm.txtYrs.value * 12; // number of monthly payments
	var paymts_fn = frm.txtYrs.value * 26;
	var paymts_wk = frm.txtYrs.value * 52;

	if (i_mn > 1.0) {
		i_mn = i_mn / 100.0;
	}
	i_mn /= 12; // /= | x/=y | x=x/y

	var pow_mn = 1;
	for (x = 0; x < paymts_mn; x++) {
		pow_mn = pow_mn * (1 + i_mn);
	}

	if (i_fn > 1.0) {
		i_fn = i_fn / 100.0;
	}
	i_fn /= 26;

	var pow_fn = 1;
	for (y = 0; y < paymts_fn; y++) {
		pow_fn = pow_fn * (1 + i_fn);
	}

	if (i_wk > 1.0) {
		i_wk = i_wk / 100.0;
	}
	i_wk /= 52;

	var pow_wk = 1;
	for(z = 0; z < paymts_wk; z++) {
		pow_wk = pow_wk * (1 + i_wk);
	}			

	var LoanTotal = ((princ * pow_mn * i_mn) / (pow_mn - 1)) * paymts_mn;
	frm.txtTotal.value = custRound(LoanTotal, 2);
	frm.txtMnth.value = custRound(((princ * pow_mn * i_mn) / (pow_mn - 1)), 2);
	frm.txtFn.value = custRound(((princ * pow_fn * i_fn) / (pow_fn - 1)), 2);
	frm.txtWk.value = custRound(((princ * pow_wk * i_wk) / (pow_wk - 1)), 2);
	frm.txtInt.value = custRound(LoanTotal - princ, 2);
}

function custRound(x,places) {
	return (Math.round(x * Math.pow(10, places))) / Math.pow(10, places);
}
