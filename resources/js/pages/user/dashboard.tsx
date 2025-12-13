import { ChartExp } from '@/components/chart-exp';
import ChartExpGainByCategory from '@/components/chart-exp-gain-by-category';
import ChartExpGainByHabit from '@/components/chart-exp-gain-by-habit';
import DashboardCard from '@/components/dashboard-card';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import {
    Bike,
    CalendarDays,
    Clock,
    ListPlus,
    ScrollText,
    SquareLibrary,
} from 'lucide-react';
import { useEffect, useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

interface DashboardProps {
    user: {
        name: string;
        email: string;
        avatar: string;
        created_at: string;
    };
    categoryCount: number;
    habitCount: number;
    habitLogCount: number;
    expTotal: string;
    chartData: [];
    expGainByCategory: [];
    expGainByHabit: [];
}

export default function Dashboard({
    user,
    categoryCount,
    habitCount,
    habitLogCount,
    expTotal,
    chartData,
    expGainByCategory,
    expGainByHabit,
}: DashboardProps) {
    const [now, setNow] = useState(new Date());

    useEffect(() => {
        const timer = setInterval(() => {
            setNow(new Date());
        }, 1000);

        return () => clearInterval(timer);
    }, []);

    const date = now.toLocaleDateString('en-EN', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    });

    const time = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="flex w-full gap-4">
                    <div className="flex-1 space-y-2 rounded-xl border border-primary p-4 bg-card">
                        <p className="text-sm font-medium">
                            👋 Welcome to dashboard, {user.name}!
                        </p>
                        <p className="text-sm font-light text-muted-foreground">
                            Small habits today create big changes tomorrow.
                            Let’s keep your habits on track today.
                        </p>
                    </div>
                    <div className="flex items-center justify-center rounded-xl border border-primary px-8 bg-card">
                        <div className="flex items-center justify-center gap-8">
                            <div className="flex items-center gap-2 text-sm">
                                <CalendarDays className="h-3.5 w-3.5"></CalendarDays>
                                {date}
                            </div>
                            <div className="font-mono text-sm font-semibold flex items-center gap-2">
                                <Clock className="h-3.5 w-3.5"></Clock>
                                {time}
                            </div>
                        </div>
                    </div>
                </div>
                <div className="grid grid-cols-4 gap-4">
                    {/* <Card className="rounded-xl p-4">
                        <div>
                            <div className="flex flex-col items-center justify-center gap-2">
                                <Avatar className="h-12 w-12 overflow-hidden rounded-full">
                                    <AvatarImage
                                        src={user.avatar}
                                        alt={user.name}
                                    />
                                    <AvatarFallback className="rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                        {getInitials(user.name)}
                                    </AvatarFallback>
                                </Avatar>
                                <div className="flex flex-col text-center">
                                    <span className="truncate font-medium">
                                        {user.name}
                                    </span>
                                    <span className="truncate text-xs text-muted-foreground">
                                        {user.email}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </Card> */}
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
                <div className="grid grid-cols-2 gap-4">
                    <ChartExpGainByCategory
                        data={expGainByCategory}
                    ></ChartExpGainByCategory>
                    <ChartExpGainByHabit
                        data={expGainByHabit}
                    ></ChartExpGainByHabit>
                </div>
            </div>
        </AppLayout>
    );
}
