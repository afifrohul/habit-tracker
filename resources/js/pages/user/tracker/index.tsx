import AppLayout from '@/layouts/app-layout';
import { lucideIcons } from '@/lib/lucide-icons';
import { BreadcrumbItem } from '@/types';
import dayGridPlugin from '@fullcalendar/daygrid';
import FullCalendar from '@fullcalendar/react';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tracker',
        href: '/tracker',
    },
];

type Habit = {
    id: number;
    name: string;
    icon: string;
    color: string;
};

type Log = {
    id: number;
    exp_gain: number;
    date: string;
    habit: Habit;
};

interface LogIndexProps {
    logs: Log[];
}

export default function Index({ logs }: LogIndexProps) {
    const events = logs.map((log) => ({
        ...log,
        id: log.id.toString(),
    }));

    const renderEventContent = (eventInfo: any) => {
        const iconName = eventInfo.event.extendedProps.icon;
        const IconComponent = (lucideIcons as Record<string, any>)[iconName];

        return (
            <div
                style={{ backgroundColor: eventInfo.event.extendedProps.color }}
                className="px-1 py-0.5"
            >
                <div className="flex items-center gap-2">
                    <IconComponent className="h-4 w-4" />
                    <p>{eventInfo.event.title}</p>
                </div>
            </div>
        );
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tracker" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="rounded-xl border p-4 text-xs">
                    <FullCalendar
                        plugins={[dayGridPlugin]}
                        initialView="dayGridMonth"
                        events={events}
                        eventContent={renderEventContent}
                        dayMaxEventRows={true}
                    />
                </div>
            </div>
        </AppLayout>
    );
}
