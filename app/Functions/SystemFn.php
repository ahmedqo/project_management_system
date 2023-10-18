<?php

namespace App\Functions;

class SystemFn
{
    public static function __getNote($var)
    {
        switch ($var) {
            case 'poor':
                return 1;
            case 'fair':
                return 2;
            case 'good':
                return 3;
            case 'excellent':
                return 4;
        }
    }

    public static function activeLink($route)
    {
        return request()->routeIs($route) ? 'bg-primary !text-white' : '';
    }

    public static function activeTab($route)
    {
        return request()->routeIs($route) ? 'border-primary' : 'border-transparent';
    }

    public static function genders()
    {
        return [
            'male',
            'female',
            'non-binary'
        ];
    }

    public static function identities()
    {
        return [
            'national',
            'passport'
        ];
    }

    public static function stages($name)
    {
        $all = [
            'status' => [
                'pending',
                'approved',
                'rejected'
            ],
            'progress' => [
                'pending',
                'ready',
                'progress',
                'closed',
                'hold'
            ],
            'legal' => [
                'pending',
                'assessing',
                'investigating',
                'hearing',
                'monitoring',
                'settled',
                'closed'
            ],
        ];

        return $all[$name];
    }

    public static function priorities()
    {
        return [
            'low',
            'medium',
            'high',
            'critical'
        ];
    }

    public static function reasons()
    {
        return [
            'other',
            'lack of work',
            'business closed down',
            'end of definite contract',
            'end of apprenticeship scheme contract',
            'end of work phase',
            'expiry of appointment',
            'failing to obtain (driving / operating) licence',
            'failing to pass physical (training / aptitude) test',
            'revocation of employment license',
            '(cancellation / suspension) of employment licence',
            'expiry of employment licence',
            'court (injunction / interdiction / sentence)',
            'disciplinary reasons',
            'failure to perform duties',
            'formal resignation',
            'did not report for work',
            'abandoned place of work',
            'early retirement',
            'retirement disciplinary corp member',
            'retirement age',
            'emigrated',
            'employed elsewhere',
            'ended self-employment',
            'further studies',
            '(transferred / moved) to another department',
            'transfer of business',
            'change in company name',
            'deceased',
            'employee reaches pension age',
            'health reason'
        ];
    }

    public static function leaves()
    {
        return [
            'annual',
            'sick',
            'maternity',
            'paternity',
            'family',
            'bereavement',
            'medical',
            'personal',
            'vacation',
            'unpaid',
            'other'
        ];
    }

    public static function expenses()
    {
        return [
            'travel',
            'meal',
            'transportation',
            'accommodation',
            'office supplies',
            'equipment purchases',
            'maintenance and repairs',
            'training and education',
            'professional services',
            'advertising and marketing',
            'utilities',
            'insurance',
            'rent or lease payments',
            'taxes',
            'miscellaneous',
            'other'
        ];
    }

    public static function compensations()
    {
        return [
            'once',
            'hourly',
            'daily',
            'weekly',
            'monthly'
        ];
    }

    public static function grievances()
    {
        return [
            'harassment or discrimination',
            'bullying or intimidation',
            'unfair treatment or favoritism',
            'hostile work environment',
            'lack of communication or transparency',
            'unsafe working conditions',
            'violation of company policies',
            'wage or salary disputes',
            'retaliation for reporting misconduct',
            'inadequate training or resources',
            'other'
        ];
    }

    public static function contracts()
    {
        return [
            'cdd',
            'cdi',
        ];
    }

    public static function note($row)
    {
        return SystemFn::__getNote($row->work) + SystemFn::__getNote($row->productivity) + SystemFn::__getNote($row->communication) + SystemFn::__getNote($row->collaboration) + SystemFn::__getNote($row->punctuality);
    }

    public static function priorityColor($priority)
    {
        switch ($priority) {
            case 'critical':
                return 'bg-red-200';
            case 'high':
                return 'bg-yellow-200';
            case 'medium':
                return 'bg-green-200';
            case 'low':
                return 'bg-blue-200';
        }
    }

    public static function randomColor()
    {
        $red = rand(0, 127);
        $green = rand(0, 127);
        $blue = rand(0, 127);

        return sprintf('#%02x%02x%02x', $red, $green, $blue);
    }
}
