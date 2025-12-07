import { LucideIcon } from 'lucide-react';

import { Card } from '@/components/ui/card';

export default function DashboardCard({
    header,
    icon: Icon,
    data,
    footer,
    className,
}: {
    header: string;
    icon?: LucideIcon | null;
    data: string;
    footer: string;
    className?: string;
}) {
    return (
        <Card className='p-4'>
            <div className={`rounded ${className ?? ''}`}>
                <div>
                    <div className="flex items-center justify-between">
                        <p className="text-sm text-neutral-500 dark:text-neutral-300">
                            {header}
                        </p>
                        <div>
                            {Icon && (
                                <Icon className="text-sm text-neutral-700 dark:text-neutral-500" />
                            )}
                        </div>
                    </div>
                    <p className="mt-2 text-2xl font-extrabold">{data}</p>
                    <p className="mt-4 text-sm font-medium">{footer}</p>
                </div>
            </div>
        </Card>
    );
}
