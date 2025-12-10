import { ChartExp } from '@/components/chart-exp';
import DashboardCard from '@/components/dashboard-card';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { Bike, ScrollText, SquareLibrary } from 'lucide-react';

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
    chartData: [];
}

export default function Dashboard({
    categoryCount,
    habitCount,
    habitLogCount,
    chartData,
}: DashboardProps) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="grid grid-cols-3 gap-4">
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
                </div>
                <div>
                    <ChartExp chartData={chartData}></ChartExp>
                </div>
            </div>
        </AppLayout>
    );
}
