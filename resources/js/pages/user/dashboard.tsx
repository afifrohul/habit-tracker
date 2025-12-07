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

export default function Dashboard({ ...props }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="grid grid-cols-3 gap-4">
                    <DashboardCard
                        header="Habit Category"
                        icon={SquareLibrary}
                        data={props.categoryCount}
                        footer="Total Habit Category(s)"
                    />
                    <DashboardCard
                        header="Habit"
                        icon={Bike}
                        data={props.habitCount}
                        footer="Total Habit(s)"
                    />
                    <DashboardCard
                        header="Habit Log"
                        icon={ScrollText}
                        data={props.habitLogCount}
                        footer="Total Habit Log(s)"
                    />
                </div>
            </div>
        </AppLayout>
    );
}
