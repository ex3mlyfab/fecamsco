<?php

if (!function_exists('prefixActive')) {
    function prefixActive($prefixName)
    {
        return    request()->route()->getPrefix() == $prefixName ? 'active' : '';
    }
}

if (!function_exists('prefixBlock')) {
    function prefixBlock($prefixName)
    {
        return    request()->route()->getPrefix() == $prefixName ? 'block' : 'none';
    }
}

if (!function_exists('routeActive')) {
    function routeActive($routeName)
    {
        return    request()->routeIs($routeName) ? 'active' : '';
    }
}

// if (!function_exists('showAmount')) {
//     function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
//     {
//         $separator = '';
//         if ($separate) {
//             $separator = ',';
//         }
//         $printAmount = number_format($amount, $decimal, '.', $separator);
//         if ($exceptZeros) {
//             $exp = explode('.', $printAmount);
//             if ($exp[1] * 1 == 0) {
//                 $printAmount = $exp[0];
//             } else {
//                 $printAmount = rtrim($printAmount, '0');
//             }
//         }
//         return $printAmount;
//     }
// }
if (!function_exists('showAmount')) {
    function showAmount($amount, $decimal = 2, $separate = true, $exceptZeros = false)
    {
        $separator = '';
        if ($separate) {
            $separator = ',';
        }
        $printAmount = number_format($amount, $decimal, '.', $separator);
        if ($exceptZeros) {
            $exp = explode('.', $printAmount);
            if ($exp[1] * 1 == 0) {
                $printAmount = $exp[0];
            } else {
                $printAmount = rtrim($printAmount, '0');
            }
        }
        return  "<span style='font-family: DejaVu Sans;'> &#x20A6;</span>" .$printAmount;
    }
}
if (!function_exists('showAmountPer')) {
    function showAmountPer($amount, $decimal = 2, $separate = true, $exceptZeros = false)
    {
        $separator = '';
        if ($separate) {
            $separator = ',';
        }
        $printAmount = number_format($amount, $decimal, '.', $separator);
        if ($exceptZeros) {
            $exp = explode('.', $printAmount);
            if ($exp[1] * 1 == 0) {
                $printAmount = $exp[0];
            } else {
                $printAmount = rtrim($printAmount, '0');
            }
        }
        return  "₦" .$printAmount;
    }
}
if (!function_exists('member_status')) {
    function member_status($status) {
        if ($status == 0) {
            return "<span class='badge badge-danger'>Newly Registered</span>";
        } else if ($status == 1) {
            return "<span class='badge badge-secondary'>denied /deactivated</span>";
        } else if ($status == 2) {
            return "<span class='badge badge-info'> awaiting approval</span>";
        } else if ($status == 3) {
            return "<span class='badge badge-success'>Member</span>";
        } else if ($status == 6) {
            return "<span class='badge badge-success'>Member (Sys Reg)</span>";
        }
    }
}
if (!function_exists('mandate_status')) {
    function mandate_status($status) {
        if ($status == 0) {
            return "<span class='badge badge-danger'>approved</span>";
        } else if ($status == 1) {
            return "<span class='badge badge-secondary'>Batched</span>";
        } else if ($status == 2) {
            return "<span class='badge badge-info'>Disbursed</span>";
        }
    }
}
if (!function_exists('loan_status')) {
    function loan_status($status) {
        if ($status == 0) {
            return "<span class='badge badge-danger'>Loan Pending Review</span>";
        } else if ($status == 1) {
            return "<span class='badge badge-secondary'>Approved</span>";
        } else if ($status == 2) {
            return "<span class='badge badge-info'> loan liquidated</span>";
        } else if ($status == 3) {
            return "<span class='badge badge-danger'>Rejected</span>";
        }
    }
}
if (!function_exists('purchase_order_status')) {
    function purchase_order_status($status) {
        if ($status == 1) {
            return "<span class='badge badge-danger'>Created</span>";
        } else if ($status == 2) {
            return "<span class='badge badge-secondary'>Approved</span>";
        } else if ($status == 3) {
            return "<span class='badge badge-info'> Declined</span>";
        } else if ($status == 4) {
            return "<span class='badge badge-danger'>Delivered/Received</span>";
        }
    }
}
if(!function_exists('user_avatar')){
    function user_avatar($avatar){
        if(isset($avatar)){
            return 'backend\images\userAvatar\\'.$avatar;
        }else{
            return 'femcas-logo.png';
        }
    }
}
