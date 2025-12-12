import { ChartExp } from '@/components/chart-exp';
import ChartExpGainByCategory from '@/components/chart-exp-gain-by-category';
import ChartExpGainByHabit from '@/components/chart-exp-gain-by-habit';
import DashboardCard from '@/components/dashboard-card';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { Bike, ListPlus, ScrollText, SquareLibrary } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

interface DashboardProps {
    categoryCount: number;
    habitCount: number;
    habitLogCount: number;
    expTotal: string;
    chartData: [];
    expGainByCategory: [];
    expGainByHabit: [];
}

export default function Dashboard({
    categoryCount,
    habitCount,
    habitLogCount,
    expTotal,
    chartData,
    expGainByCategory,
    expGainByHabit
}: DashboardProps) {

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="grid grid-cols-4 gap-4">
                    <DashboardCard
                        header="Habit Category"
                        icon={SquareLibrary}
                        data={categoryCount}
                        footer="Total Habit Category(s)"
                    />
                    <DashboardCard
                        header="Habit"
                        icon={Bike}
                        data={habitCount}
                        footer="Total Habit(s)"
                    />
                    <DashboardCard
                        header="Habit Log"
                        icon={ScrollText}
                        data={habitLogCount}
                        footer="Total Habit Log(s)"
                    />
                    <DashboardCard
                        header="Exp Gain"
                        icon={ListPlus}
                        data={Number(expTotal)}
                        footer="Total Exp Gain(s)"
                    />
                </div>
                <div>
                    <ChartExp chartData={chartData}></ChartExp>
                </div>
                <div className='grid grid-cols-2 gap-4'>
                    <ChartExpGainByCategory data={expGainByCategory}></ChartExpGainByCategory>
                    <ChartExpGainByHabit data={expGainByHabit}></ChartExpGainByHabit>
                </div>
            </div>
        </AppLayout>
    );
}
